<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class UserController extends ResourceController
{
    protected $modelName    = 'App\Models\User';
    protected $format       = 'json';            //format api adalah json

    /**
     * handle user login
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data_user' => $this->model->findAll()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Validasi input
        $rules = [
            'username' => 'required',
            'email'    => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Hash password sebelum disimpan
        $hashedPassword = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        // Simpan data user
        $this->model->insert([
            'username' => esc($this->request->getVar('username')),
            'email'    => esc($this->request->getVar('email')),
            'password' => $hashedPassword,
        ]);

        return $this->respondCreated(['message' => 'Akun berhasil dibuat.']);
    }

    /**
     * Update user profile
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
        ];
    
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
    
        $user = $this->model->find($id);
    
        if (!$user) {
            return $this->failNotFound("User not found");
        }
    
        // Data untuk update
        $updateData = [
            'username' => esc($this->request->getVar('username')),
            'email'    => esc($this->request->getVar('email')),
        ];
    
        if ($this->request->getVar('password')) {
            $updateData['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }
    
        $this->model->update($id, $updateData);
    
        return $this->respond(['message' => 'Profile updated successfully.'], 200);
    }

    /**
     * Delete user
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if (!$id) {
            return $this->failNotFound("User ID is required.");
        }
    
        $user = $this->model->find($id);
    
        if (!$user) {
            return $this->failNotFound("User not found");
        }
    
        $this->model->delete($id);
    
        return $this->respondDeleted(['message' => 'Akun berhasil dihapus.']);
    }

}
