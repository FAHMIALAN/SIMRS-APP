<?php

namespace App\Controllers;

use App\Models\DokterModel;

class DokterController extends BaseController
{
    protected $dokterModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Dokter',
            'dokter' => $this->dokterModel->findAll()
        ];
        return view('admin/dokter/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Dokter'];
        return view('admin/dokter/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'spesialis' => 'required',
            'no_telp' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->dokterModel->save([
            'nama' => $this->request->getPost('nama'),
            'spesialis' => $this->request->getPost('spesialis'),
            'no_telp' => $this->request->getPost('no_telp'),
        ]);

        return redirect()->to('/admin/dokter')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Dokter',
            'dokter' => $this->dokterModel->find($id)
        ];
        return view('admin/dokter/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => 'required',
            'spesialis' => 'required',
            'no_telp' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->dokterModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'spesialis' => $this->request->getPost('spesialis'),
            'no_telp' => $this->request->getPost('no_telp'),
        ]);

        return redirect()->to('/admin/dokter')->with('success', 'Data dokter berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->dokterModel->delete($id);
        return redirect()->to('/admin/dokter')->with('success', 'Data dokter berhasil dihapus.');
    }
}
