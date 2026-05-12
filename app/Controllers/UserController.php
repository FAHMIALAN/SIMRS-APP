<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->userModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => "required|valid_email|is_unique[users.email,id,$id]",
            'role'     => 'required'
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'id'       => $id,
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->save($updateData);

        return redirect()->to('/admin/user')->with('success', 'Data user berhasil diupdate.');
    }

    public function delete($id)
    {
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/user')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus.');
    }
}
