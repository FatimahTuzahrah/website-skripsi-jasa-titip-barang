<?php

namespace App\Controllers;

class Owner extends BaseController
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
        $model = new \App\Models\OwnerModel();

        return view('Owner/index', [
            'model' => $model->findAll(),
        ]);
    }

    public function create()
    {
        //jika data yang dipost

        $provinsi = $this->rajaongkir('province');

        return view('owner/create', [
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ]);
    }

    public function getCityOwner()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGET('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
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
