<?php

namespace App\Controllers;

use App\Models\JenisPelaporModel;

class JenisPelapor extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new JenisPelaporModel();
    }

    // INDEX
    public function index()
    {
        $data['jenis'] = $this->model->findAll();
        return view('jenis_pelapor/index', $data);
    }

    // CREATE
    public function create()
    {
        return view('jenis_pelapor/create');
    }

    // STORE
    public function store()
    {
        $this->model->save([
            'nama_jenis' => $this->request->getPost('nama_jenis')
        ]);

        return redirect()->to('/jenispelapor');
    }

    // EDIT
    public function edit($id)
    {
        $data['jenis'] = $this->model->find($id);
        return view('jenis_pelapor/edit', $data);
    }

    // UPDATE
    public function update($id)
    {
        $this->model->update($id, [
            'nama_jenis' => $this->request->getPost('nama_jenis')
        ]);

        return redirect()->to('/jenispelapor');
    }

    // DELETE
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/jenispelapor');
    }
}