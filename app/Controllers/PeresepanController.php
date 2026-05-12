<?php

namespace App\Controllers;

use App\Models\PeresepanModel;
use App\Models\PeresepanDetailModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\ObatModel;

/**
 * PeresepanController
 * 
 * Mengatur semua logika terkait peresepan obat medis termasuk
 * pembuatan, riwayat, detail, dan pelaporan.
 */
class PeresepanController extends BaseController
{
    /**
     * @var PeresepanModel
     */
    protected $peresepanModel;

    /**
     * @var PeresepanDetailModel
     */
    protected $peresepanDetailModel;

    /**
     * @var PasienModel
     */
    protected $pasienModel;

    /**
     * @var DokterModel
     */
    protected $dokterModel;

    /**
     * @var ObatModel
     */
    protected $obatModel;

    /**
     * @var \CodeIgniter\Database\BaseConnection
     */
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->peresepanModel = new PeresepanModel();
        $this->peresepanDetailModel = new PeresepanDetailModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
        $this->obatModel = new ObatModel();
    }

    /**
     * Menampilkan daftar semua peresepan
     */
    public function index()
    {
        $data = [
            'title' => 'Riwayat Peresepan',
            'peresepan' => $this->peresepanModel->getPeresepanWithDetails()
        ];
        return view('admin/peresepan/index', $data);
    }

    /**
     * Menampilkan form untuk membuat peresepan baru
     */
    public function create()
    {
        $data = [
            'title' => 'Buat Peresepan Baru',
            'pasien' => $this->pasienModel->findAll(),
            'dokter' => $this->dokterModel->findAll(),
            'obat' => $this->obatModel->where('stok >', 0)->findAll()
        ];
        return view('admin/peresepan/create', $data);
    }

    /**
     * Menyimpan peresepan baru dan detailnya ke dalam database
     */
    public function store()
    {
        $rules = [
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'tanggal'   => 'required|valid_date',
            'obat_id'   => 'required',
            'jumlah'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $obatIds = $this->request->getPost('obat_id');
        $jumlahs = $this->request->getPost('jumlah');

        $totalHarga = 0;
        $details = [];

        // Logika transaksi untuk memastikan integritas data (atomicity)
        $this->db->transStart();

        foreach ($obatIds as $key => $obatId) {
            $obat = $this->obatModel->find($obatId);
            $qty = $jumlahs[$key];
            if($obat && $qty > 0) {
                $subtotal = $obat['harga'] * $qty;
                $totalHarga += $subtotal;
                $details[] = [
                    'obat_id' => $obatId,
                    'jumlah' => $qty,
                    'subtotal' => $subtotal
                ];

                // Kurangi stok obat
                $this->obatModel->update($obatId, ['stok' => $obat['stok'] - $qty]);
            }
        }

        if(empty($details)) {
             $this->db->transRollback();
             return redirect()->back()->withInput()->with('error', 'Pilih minimal 1 obat.');
        }

        $peresepanData = [
            'pasien_id' => $this->request->getPost('pasien_id'),
            'dokter_id' => $this->request->getPost('dokter_id'),
            'user_id'   => session()->get('user_id'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'total_harga' => $totalHarga
        ];

        $this->peresepanModel->insert($peresepanData);
        $peresepanId = $this->peresepanModel->getInsertID();

        foreach($details as &$detail) {
            $detail['peresepan_id'] = $peresepanId;
        }
        $this->peresepanDetailModel->insertBatch($details);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
             return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data peresepan.');
        }

        return redirect()->to('/admin/peresepan')->with('success', 'Transaksi peresepan berhasil disimpan.');
    }

    /**
     * Menampilkan tampilan detail dari peresepan tertentu
     */
    public function show($id)
    {
        $data = [
            'title' => 'Detail Peresepan',
            'peresepan' => $this->peresepanModel->getPeresepanWithDetails($id),
            'details' => $this->peresepanDetailModel->getDetailsByPeresepanId($id)
        ];
        return view('admin/peresepan/show', $data);
    }

    /**
     * Menghasilkan laporan penjualan harian atau bulanan
     */
    public function report()
    {
        $tanggal = $this->request->getGet('tanggal');
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $builder = $this->db->table('peresepan');
        $builder->select('peresepan.*, pasien.nama as nama_pasien, dokter.nama as nama_dokter');
        $builder->join('pasien', 'pasien.id_pasien = peresepan.pasien_id');
        $builder->join('dokter', 'dokter.id = peresepan.dokter_id');
        
        // Pemfilteran dinamis berdasarkan input
        if ($tanggal) {
            $builder->where('peresepan.tanggal', $tanggal);
        } else {
            $builder->where('MONTH(peresepan.tanggal)', $bulan, false);
            $builder->where('YEAR(peresepan.tanggal)', $tahun, false);
        }
        
        $peresepan = $builder->get()->getResultArray();

        $data = [
            'title' => 'Laporan Peresepan Obat',
            'peresepan' => $peresepan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tanggal_filter' => $tanggal
        ];
        return view('admin/peresepan/report', $data);
    }
}
