<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\ObatModel;
use App\Models\PeresepanModel;

/**
 * DashboardController
 * 
 * Mengelola tampilan dashboard utama untuk peran Admin dan User/Pasien.
 */
class DashboardController extends BaseController
{
    /**
     * Dashboard Admin: Statistik dan Aktivitas Terbaru
     */
    public function admin()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/user/dashboard');
        }

        $pasienModel = new PasienModel();
        $dokterModel = new DokterModel();
        $obatModel = new ObatModel();
        $peresepanModel = new PeresepanModel();

        $data = [
            'total_pasien' => $pasienModel->countAllResults(),
            'total_dokter' => $dokterModel->countAllResults(),
            'total_obat'   => $obatModel->countAllResults(),
            'total_peresepan' => $peresepanModel->countAllResults(),
            'total_penjualan' => $peresepanModel->selectSum('total_harga')->get()->getRow()->total_harga ?? 0,
            'recent_peresepan' => $peresepanModel->getPeresepanWithDetails(),
            'title' => 'Dashboard Admin'
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Dashboard User/Pasien: Profil pribadi dan riwayat medis
     */
    public function user()
    {
        if (session()->get('role') !== 'user') {
            return redirect()->to('/admin/dashboard');
        }

        $pasienModel = new PasienModel();
        $peresepanModel = new PeresepanModel();
        
        $userId = session()->get('user_id');
        $pasien = $pasienModel->where('user_id', $userId)->first();
        
        $riwayat = [];
        if ($pasien) {
            $allRiwayat = $peresepanModel->getPeresepanWithDetails();
            // Filter catatan yang dimiliki oleh pasien saat ini
            $riwayat = array_filter($allRiwayat, function($r) use ($pasien) {
                return $r['pasien_id'] == $pasien['id_pasien'];
            });
        }

        $data = [
            'title' => 'Dashboard User',
            'pasien' => $pasien,
            'riwayat' => $riwayat
        ];

        return view('user/dashboard', $data);
    }

    /**
     * Menampilkan detail peresepan/struk untuk pengguna
     */
    public function userShowPeresepan($id)
    {
        if (session()->get('role') !== 'user') {
            return redirect()->to('/admin/dashboard');
        }

        $pasienModel = new PasienModel();
        $peresepanModel = new PeresepanModel();
        $detailModel = new \App\Models\PeresepanDetailModel();
        
        $userId = session()->get('user_id');
        $pasien = $pasienModel->where('user_id', $userId)->first();
        $peresepan = $peresepanModel->getPeresepanWithDetails($id);

        // Pemeriksaan keamanan: pastikan pengguna hanya melihat peresepan milik mereka sendiri
        if (!$pasien || !$peresepan || $peresepan['pasien_id'] != $pasien['id_pasien']) {
            return redirect()->to('/user/dashboard')->with('error', 'Akses ditolak atau data tidak ditemukan.');
        }

        $data = [
            'title' => 'Struk Peresepan',
            'peresepan' => $peresepan,
            'details' => $detailModel->getDetailsByPeresepanId($id)
        ];

        return view('user/peresepan_show', $data);
    }
}
