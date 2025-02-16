<?php

namespace App\Controllers;

use App\Models\AnakModel;
use CodeIgniter\RESTful\ResourceController;

class AnakController extends ResourceController
{
    protected $modelName = 'App\Models\AnakModel';
    protected $format    = 'json';

    public function index()
    {
        $anakModel = new AnakModel();
        $anakData = $anakModel->findAll();

        return $this->respond($anakData);
    }

    public function show($id = null)
    {
        $anakModel = new AnakModel();
        $data = $anakModel->find($id);

        if (!$data) {
            return $this->failNotFound('Data anak tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function save()
    {
        $anakModel = new AnakModel();

        $data = $this->request->getPost();
        
        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'tanggal_update' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required|integer',
            'berat_badan' => 'required|decimal',
            'tinggi_badan' => 'required|decimal',
            'lingkar_lengan_atas' => 'required|decimal'
        ])) {
            return $this->failValidationErrors('Data tidak valid');
        }

        $anakModel->save($data);

        return $this->respondCreated(['status' => 'success', 'message' => 'Data anak berhasil disimpan']);
    }
}
