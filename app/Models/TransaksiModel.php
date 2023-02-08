<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_stuff', 'id_user', 'jumlah', 'total_harga', 'order_id', 'id_owner', 'ongkir', 'barang', 'service_pengiriman', 'status', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Transaksi';
    protected $useTimestamps = false;


    // public function transaksi()
    // {
    //     $transaksi = $this->db->table('transaksi')
    //         ->join('stuff', 'transaksi.id_stuff =  stuff.id')
    //         ->get();
    //     return $transaksi;
    // }

    public function search($keyword)
    {
        return $this->table('transaksi')->like('status', $keyword);
    }
}
