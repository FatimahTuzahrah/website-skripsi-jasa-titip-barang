<?php

namespace App\Controllers;

class Pengiriman extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \config\Services::validation();
        $this->session = session();
    }

    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->join('stuff', 'stuff.id=transaksi.id_stuff')
            ->join('user', 'user.id=transaksi.id_user')
            ->where('transaksi.id', $id)
            ->first();

        return view('pengiriman/jadwal', [
            'transaksi' => $transaksi,
        ]);
    }

    public function jadwal()
    {
        // $transaksiModel = new \App\Models\TransaksiModel();
        // $id_user = $this->session->get('id');
        // $model = $transaksiModel->where('id_pembeli', $id_user)->findAll();

        // return view('pengiriman/jadwal', [
        //     'model' => $model,
        //     // 'transaksi' => $transaksi,
        // ]);
    }
}
