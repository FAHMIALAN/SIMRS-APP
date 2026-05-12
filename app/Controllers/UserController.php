<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * UserController
 * 
 * Manages the users who can access the system, including creating admins and staff.
 */
class UserController extends BaseController
{
    /**
     * @var UserModel
     */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display a list of all registered users
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user/index', $data);
    }

    /**
     * Show form to create a new user
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/create', $data);
    }

    /**
     * Store a new user in the database
     */
    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required'
        ];

        if (!$this->validate($rules)) {
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

    /**
     * Show form to edit an existing user
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->userModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/edit', $data);
    }

    /**
     * Update user details in the database
     */
    public function update($id)
    {
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => "required|valid_email|is_unique[users.email,id,$id]",
            'role'     => 'required'
        ];

        // Only validate password if it's being changed
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

    /**
     * Delete a user record (prevents self-deletion)
     */
    public function delete($id)
    {
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/user')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus.');
    }
}
