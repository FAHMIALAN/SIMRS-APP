<?php

namespace App\Controllers;

use App\Models\ObatModel;

class ObatController extends BaseController
{
    protected $obatModel;

    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Obat',
            'obat' => $this->obatModel->findAll()
        ];
        return view('admin/obat/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Obat'];
        return view('admin/obat/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_obat' => 'required',
            'jenis' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->obatModel->save([
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/admin/obat')->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Obat',
            'obat' => $this->obatModel->find($id)
        ];
        return view('admin/obat/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_obat' => 'required',
            'jenis' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->obatModel->update($id, [
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/admin/obat')->with('success', 'Data obat berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->obatModel->delete($id);
        return redirect()->to('/admin/obat')->with('success', 'Data obat berhasil dihapus.');
    }
}
