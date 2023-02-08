<?php

namespace App\Models;

use CodeIgniter\Model;

class StuffModel extends Model
{
    protected $table = 'stuff';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'nama', 'harga', 'nama_jastip', 'stok', 'gambar', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Stuff';
    protected $useTimestamps = false;
}
