<?php

namespace App\Models;

use CodeIgniter\Model;

class ratemodel extends Model
{
    protected $table = 'rate';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_stuff', 'id_user', 'star',  'created_date', 'created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\rate';
    protected $useTimestamps = false;
}
