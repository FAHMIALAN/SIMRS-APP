<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(session()->get('role') == 'admin' ? '/admin/dashboard' : '/user/dashboard');
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            $sessionData = [
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);
            
            return redirect()->to($user['role'] == 'admin' ? '/admin/dashboard' : '/user/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau Password salah.');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(session()->get('role') == 'admin' ? '/admin/dashboard' : '/user/dashboard');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'username'         => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'nama'             => 'required',
            'alamat'           => 'required',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new \App\Models\UserModel();
        $pasienModel = new \App\Models\PasienModel();

        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Simpan ke tabel users
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user',
        ];
        $userModel->insert($userData);
        $userId = $userModel->getInsertID();

        // 2. Generate Nomor RM (Cth: RM-240512-001)
        $datePart = date('ymd');
        $count = $pasienModel->where('DATE(created_at)', date('Y-m-d'))->countAllResults() + 1;
        $nomorRM = 'RM-' . $datePart . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        // 3. Simpan ke tabel pasien
        $pasienData = [
            'nomor_rm' => $nomorRM,
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'user_id'  => $userId
        ];
        $pasienModel->insert($pasienData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Registrasi gagal, silakan coba lagi.');
        }

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Nomor RM Anda: ' . $nomorRM . '. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
