<?php

namespace App\Controllers;

use App\Models\TanggapanModel;

class Tanggapan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TanggapanModel();
    }

    // 🔹 INDEX
    public function index()
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $data['tanggapan'] = $this->model
            ->select('tanggapan.*, users.nama, pengaduan.judul')
            ->join('users', 'users.id_user = tanggapan.id_user')
            ->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan')
            ->findAll();

        return view('tanggapan/index', $data);
    }

    // 🔹 CREATE
    public function create($id_pengaduan)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $db = db_connect();

        $data['pengaduan'] = $db->table('pengaduan')
            ->where('id_pengaduan', $id_pengaduan)
            ->get()->getRowArray();

        return view('tanggapan/create', $data);
    }

    // 🔹 STORE
    public function store()
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $file = $this->request->getFile('foto');
        $namaFoto = null;

        if ($file && $file->isValid()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/tanggapan/', $namaFoto);
        }

        $this->model->save([
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
            'id_user' => session()->get('id_user'),
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan'),
            'foto' => $namaFoto
        ]);

        return redirect()->to('/pengaduan/detail/' . $this->request->getPost('id_pengaduan'));
    }

    // 🔹 EDIT
    public function edit($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $data['tanggapan'] = $this->model->find($id);

        return view('tanggapan/edit', $data);
    }

    // 🔹 UPDATE
    public function update($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $this->model->update($id, [
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan')
        ]);

        return redirect()->to('/tanggapan');
    }

    // 🔹 DELETE
    public function delete($id)
    {
        if(session()->get('role') != 'admin'){
            return redirect()->to('/');
        }

        $this->model->delete($id);
        return redirect()->to('/tanggapan');
    }
}