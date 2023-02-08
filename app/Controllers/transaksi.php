<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

use App\Models\gambar;

use Config\App;
use TCPDF;
use TPDF;
use Dompdf\Dompdf;

class Transaksi extends BaseController
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

        return view('transaksi/view', [
            'transaksi' => $transaksi,
        ]);
    }

    public function index()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $id_user = $this->session->get('id');
        $model = $transaksiModel->where('id_user', $id_user)->findAll();

        return view('transaksi/index', [
            'model' => $model,
            // 'keyword' => $keyword,
        ]);
    }

    public function Selesai()
    {
        $data = new \App\Models\gambar();
        $gambar = $data->findAll();
        // echo json_encode($gambar);
        return view('transaksi/Selesai', [
            'gambar' => $gambar
        ]);
    }

    public function pembayaran()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $model = $transaksiModel->findAll();
        return view('transaksi/pembayaran', [
            'model' => $model,
        ]);
    }

    public function owner()
    {
        $OwnerModel = new \App\Models\OwnerModel();
        $data = $OwnerModel->findAll();
        $transaksi =   new \App\Models\TransaksiModel();
        $trans = $transaksi->findAll();
        return view('transaksi/Owner', [
            'data' => $data,
            'trans' => $trans,
            'title' => "owner"
        ]);
    }

    public function kirim()
    {
        $id = $this->request->uri->getSegment(3);
        $modelKirim = new \App\Models\KirimModel();

        $model = $modelKirim->find($id);

        return view('transaksi/kirim', [
            'model' => $model,
        ]);
    }


    public function invoice()
    {
        $id = $this->request->uri->getSegment(3);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        $userModel = new \App\Models\UserModel();
        $pembeli = $userModel->find($transaksi->id_user);

        $stuffModel = new \App\Models\StuffModel();
        $stuff = $stuffModel->find($transaksi->id_stuff);

        $html = view('transaksi/invoice', [
            'transaksi' => $transaksi,
            'pembeli' => $pembeli,
            'stuff' => $stuff,
        ]);
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jastip Maluku Utara');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('JastipInvoice.pdf', 'I');
    }

    // public function finishMidtrans(){
    //     if($this->request->isAJAX()){
    //         $order_id= $this->request->getPost('order_id'),
    //         $transaction_time= $this->request->getPost('transaction_time'),
    //         $transaction_status= $this->request->getPost('transaction_status'),
    //         $va_number= $this->request->getPost('va_number'),
    //         $bank= $this->request->getPost('bank'),
    //     }
    // }
}
