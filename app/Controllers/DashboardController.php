<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\ObatModel;
use App\Models\PeresepanModel;

class DashboardController extends BaseController
{
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
            'recent_peresepan' => $peresepanModel->getPeresepanWithDetails(), // Update this to get patient names
            'title' => 'Admin Dashboard'
        ];

        return view('admin/dashboard', $data);
    }

    public function user()
    {
        if (session()->get('role') !== 'user') {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'User Dashboard'
        ];

        return view('user/dashboard', $data);
    }
}
