<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\ObatModel;
use App\Models\PeresepanModel;

/**
 * DashboardController
 * 
 * Manages the main dashboard views for both Admin and User/Patient roles.
 */
class DashboardController extends BaseController
{
    /**
     * Admin Dashboard: Statistics and Recent Activity
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
            'title' => 'Admin Dashboard'
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * User/Patient Dashboard: Personal profile and medical history
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
            // Filter records belonging to the current patient
            $riwayat = array_filter($allRiwayat, function($r) use ($pasien) {
                return $r['pasien_id'] == $pasien['id_pasien'];
            });
        }

        $data = [
            'title' => 'User Dashboard',
            'pasien' => $pasien,
            'riwayat' => $riwayat
        ];

        return view('user/dashboard', $data);
    }

    /**
     * Display detailed prescription/receipt for a user
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

        // Security check: ensure user only sees their own prescription
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
