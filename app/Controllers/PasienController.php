<?php

namespace App\Controllers;
use App\Models\PasienModel;

class PasienController extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Data Pasien',
            'pasien' => $this->pasienModel->orderBy('id_pasien', 'DESC')->findAll()
        ];
        return view('pasien/index', $data);
    }

    public function create()
    {
        // session() dikirim untuk menampilkan error validasi
        $data = [
            'title' => 'Tambah Pasien Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('pasien/create', $data);
    }

    public function store()
    {
        // Validasi Input
        if (!$this->validate([
            'nomor_rm' => [
                'rules' => 'required|is_unique[pasien.nomor_rm]',
                'errors' => [
                    'required' => 'Nomor RM harus diisi.',
                    'is_unique' => 'Nomor RM sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama pasien harus diisi.']
            ]
        ])) {
            return redirect()->to('/pasien/create')->withInput();
        }

        // Simpan Data
        $this->pasienModel->save([
            'nomor_rm' => $this->request->getPost('nomor_rm'),
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pasien',
            'validation' => \Config\Services::validation(),
            'pasien' => $this->pasienModel->find($id)
        ];
        return view('pasien/edit', $data);
    }

    public function update($id)
    {
        // Validasi sederhana untuk update
        if (!$this->validate([
            'nama' => 'required'
        ])) {
            return redirect()->to('/pasien/edit/' . $id)->withInput();
        }

        $this->pasienModel->save([
            'id_pasien' => $id,
            'nomor_rm'  => $this->request->getPost('nomor_rm'),
            'nama'      => $this->request->getPost('nama'),
            'alamat'    => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil diubah.');
    }

    public function delete($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil dihapus.');
    }
}