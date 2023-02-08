<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnerModel extends Model
{
    protected $table = 'owner';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_stuff', 'id_user', 'nama_jastip', 'alamat_jastip', 'jenis_jastip', 'tempat_transit', 'nama_owner', 'gambar', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Owner';
    protected $useTimestamps = false;
}
