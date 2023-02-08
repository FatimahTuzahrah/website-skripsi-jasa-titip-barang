<?php

namespace App\Models;

use CodeIgniter\Model;

class gambar extends Model
{
    protected $table = 'gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'nama_barang', 'gambar', 'deskripsi'
    ];
    protected $returnType = 'App\Entities\gambar';
    protected $useTimestamps = false;
}
