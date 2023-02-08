<?php

namespace App\Models;

use CodeIgniter\Model;

class peran_sebagai extends Model
{
    protected $table = 'peran_sebagai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_role', 'peran', 'created_date', 'updated_date',
    ];
    protected $returnType = 'App\Entities\Peran_sebagai';
    protected $useTimestamps = false;
}
