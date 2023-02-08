<?php

namespace App\Models;

use CodeIgniter\Model;

class KirimModel extends Model
{
    protected $table = 'kirim';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'id_stuff', 'skenario', 'banyak_gen', 'maksimal_generasi', 'crossover_rate', 'mutasi_rate', 'create_date', 'updated_by', 'updated_date'
    ];
    protected $returnType = 'App\Entities\kirim';
    protected $useTimestamps = false;
}
