<?php

namespace App\Controllers;

class Auth extends BaseController
{
    private $url = "https://pro.rajaongkir.com/api/";
    private $apiKey = "d94cd20d45f8ec72f7469d3ce0324db1";

    public function __construct()
    {
        helper('form');
        $this->validation = \config\Services::validation();
        $this->session = session();
    }

    public function register()
    {
        // if ($this->request->isAJAX()) {
        //     $peran_sebagai = new \App\Models\Peran_sebagai();
        //     $data['peran'] = $peran_sebagai->findAll();
        // }
        $provinsi = $this->rajaongkir('province');
        if ($this->request->getPost()) {
            //lakukan validasi untuk data yang dipost
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'register');
            $errors = $this->validation->getErrors();

            //jika tidak ada error jalankan
            if (!$errors) {
                $userModel = new \App\Models\UserModel();

                $user = new \App\Entities\User();

                $user->username = $this->request->getPost('username');
                $user->password = $this->request->getPost('password');

                $user->created_by = 0;
                $user->created_date = date("Y-m-d H:i:s");

                $userModel->save($user);

                return view('login');
            }

            $this->session->setFlashdata('errors', $errors);
        }
        return view('register', [
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ]);
    }

    public function getCity()
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

    public function login()
    {
        if ($this->request->getPost()) {
            //lakukan validasi untuk data yang dipost
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');
            $errors = $this->validation->getErrors();

            if ($errors) {
                return view('login');
            }

            $userModel = new \App\Models\UserModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if ($user) {
                $salt = $user->salt;
                if ($user->password !== md5($salt . $password)) {
                    $this->session->setFlashdata('errors', ['Password Salah']);
                } else {
                    $sessData = [
                        'username' => $user->username,
                        'id' => $user->id,
                        'role' => $user->role,
                        'isLoggedIn' => TRUE
                    ];

                    $this->session->set($sessData);

                    return redirect()->to(site_url('home/index'));
                }
            } else {
                $this->session->setFlashdata('errors', ['User Tidak Ditemukan']);
            }
        }
        return view('login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('auth/login'));
    }
}
