<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakModel extends Model
{
    protected $table      = 'anak';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'nama', 
    'tanggal_update',
    'tanggal_lahir', 
    'jenis_kelamin', 
    'usia', 
    'berat_badan', 
    'tinggi_badan', 
    'lingkar_lengan_atas'];
}
