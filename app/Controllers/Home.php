<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $url = "https://pro.rajaongkir.com/api/";
    private $apiKey = "d94cd20d45f8ec72f7469d3ce0324db1";

    public function __construct()
    {
        helper('form');
        $this->validation = \config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $stuff = new \App\Models\StuffModel();
        $model = $stuff->findAll();
        return view('hello/world', [
            'model' => $model,
            'data' => 'Hello World Juga',
        ]);
    }

    // public function helloOwner()
    // {
    //     $user = new \App\Models\UserModel();
    //     $id_user = $this->session->get('id');
    //     $user = $UserModel->select('user .*,username.id as id_user, username.harga,username.nama')->join('stuff as barang', 'user.id_stuff=barang.id')
    //         ->where('id_pembeli', $id_user)->findall();
    //     return view('hello/helloOwner', [
    //         'id_pembeli' => $user,
    //         'data' => 'Hello World Juga',
    //     ]);
    // }

    public function beli()
    {
        $id = $this->request->uri->getSegment(3);
        $id_user = $this->session->get('id');
        $user = new \App\Models\UserModel();
        $user_data = $user->find($id_user);
        $modelStuff = new \App\Models\StuffModel();

        $modelKomentar = new \App\Models\KomentarModel();

        $komentar = $modelKomentar->where('id_stuff', $id)->findAll();

        $model = $modelStuff->find($id);

        $provinsi = $this->rajaongkir('province');

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $transaksiModel = new \App\Models\TransaksiModel();
                $transaksi = new \App\Entities\Transaksi();

                $modelStuff = new \App\Models\StuffModel();
                $id_stuff = $this->request->getPost('id_stuff');
                $jumlah_pembelian = $this->request->getPost('jumlah');

                $stuff = $modelStuff->find($id_stuff);
                $entityStuff = new \App\Entities\Stuff();
                //disini kurang di part 5
                $entityStuff->id = $id_stuff;

                $entityStuff->stok = $stuff->stok - $jumlah_pembelian;
                $modelStuff->save($entityStuff);

                $transaksi->fill($data);
                $transaksi->status = 0;
                $transaksi->create_by = $this->session->get('id');
                $transaksi->create_date = date("Y-m-d H:i:s");

                $transaksiModel->save($transaksi);

                $id = $transaksiModel->insertID();

                $segment = ['transaksi', 'view', $id];

                return redirect()->to(site_url($segment));
            }
        }

        return view('hello/beli', [
            'model' => $model,
            'user' => $user_data,
            'komentar' => $komentar,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ]);
    }

    public function simpanTransaksi()
    {
        $harga1 = $this->request->getPost('harga');
        $firstname1 = $this->request->getPost('firstname');
        $lastname1 = $this->request->getPost('lastname');
        $no_telfon = $this->request->getPost('nophone');
        $address = $this->request->getPost('address');
        $namabarang = $this->request->getPost('namabarang');
        $postalCode = $this->request->getPost('postalcode');
        $city = $this->request->getPost('city');
        $orderid = $this->request->getPost('orderid');
        $ongkir = $this->request->getPost("ongkirBarang");
        $jumlah = $this->request->getPost('jumlahBarang');
        $transactiontime = $this->request->getPost('transactiontime');
        $transactionstatus = $this->request->getPost('transactionstatus');
        $id_stuff_barang = $this->request->getPost('id_stuff_barang');
        $idowner = $this->request->getPost('idowner');
        $service = $this->request->getPost('kurir');
        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = new \App\Entities\Transaksi();
        // [order_id] => 684742465

        $data = array("created_date" => date("Y-m-d H:i:s"), "total_harga" => $harga1, "alamat" => $address, "order_id" => $orderid, "id_owner" => "0", "ongkir" => $ongkir, "id_user" => $this->session->get('id'), 'status' => '0', 'order_id' => $orderid, 'created_by' => $this->session->get('id'), 'id_stuff' => $id_stuff_barang, 'jumlah' => $jumlah, 'service_pengiriman' => $service);

        // print_r($data);

        $transaksi->fill($data);
        $transaksi->create_date = date("Y-m-d H:i:s");
        $transaksi->order_id = $orderid;

        $transaksiModel->save($transaksi);
        $id = $transaksiModel->insertID();

        $segment = ['transaksi', 'view', $id];
        return redirect()->to(site_url($segment));
    }

    public function getSnaptoken()
    {
        // Set your Merchant Server Key
        $harga1 = $this->request->getPost('harga');
        $firstname1 = $this->request->getPost('firstname');
        $lastname1 = $this->request->getPost('lastname');
        $no_telfon = $this->request->getPost('no_telfon');
        $email1 = $this->request->getPost('email');
        $address = $this->request->getPost('alamat');
        $namabarang = $this->request->getPost('namabarang');
        $postalCode = $this->request->getPost('postalcode');

        $city = $this->request->getPost('city');
        // $data = array('harga' => $harga1, 'firstname' => $firstname1, 'lastname' => $lastname1, 'no_tlp' => $no_telfon, 'email' => $email1, 'address' => $address, 'nama_barang' => $namabarang);


        // firstname: "Fatimah",
        // lastname: "Kevin",
        // nophone: "08777722112",
        // address: "Beji Depok 1",
        $harga = (int) $harga1;
        $firstname =  $firstname1;
        $lastname =  $lastname1;
        $email =  $email1;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-mT5YT5fvIDb23-GmC6qeV1Am';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $harga, // no decimal allowed for creditcard

        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $harga,
            'quantity' => 1,
            'name' => $namabarang,
        );

        // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 25000,
        //     'quantity' => 1,
        //     'name' => ""
        // );

        // Optional
        $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => $firstname,
            'last_name'     => $lastname,
            'address'       => $address,
            'city'          => $city,
            'postal_code'   => $postalCode,
            'phone'         => $no_telfon,
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => $firstname1,
            'last_name'     => $lastname,
            'address'       => $address,
            'city'          => $city,
            'postal_code'   => $postalCode,
            'phone'         => $no_telfon,
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $firstname,
            'last_name'     => $lastname,
            'email'         => $email,
            'phone'         => $no_telfon,
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address,

        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 2
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        $data = [
            'snapToken' => \Midtrans\Snap::getSnapToken($transaction_data)
        ];

        // print_r($transaction_data);
        return $data['snapToken'];
        // print_r($data);
        // return $data;
    }

    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGET('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGET('origin');
            $destination = $this->request->getGET('destination');
            $weight = $this->request->getGET('weight');
            $courier = $this->request->getGET('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);

            return $this->response->setJSON($data);
        }
    }

    private function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&originType=city" . "&destination=" . $destination . "&destinationType=city" . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }
}
