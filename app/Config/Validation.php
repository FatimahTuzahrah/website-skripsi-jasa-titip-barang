<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $register = [
        'username' => [
            'rules' => 'required|min_length[8]',
        ],
        'password' => [
            'rules' => 'required'
        ],
        'repeatPassword' => [
            'rules' => 'required|matches[password]',
        ],
    ];

    public $register_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 8 karakter',
        ],
        'password' => [
            'required' => '{field} Harus Diisi',
        ],
        'repeatPassword' => [
            'required' => '{field} Harus Diisi',
            'matches' => '{field} Tidak Match Dengan Password'
        ],
    ];

    public $login = [
        'username' => [
            'rules' => 'required|min_length[8]',
        ],
        'password' => [
            'rules' => 'required'
        ],
    ];

    public $transaksi = [
        'id_stuff' => [
            'rules' => 'required',
        ],
        'id_user' => [
            'rules' => 'required'
        ],
        'jumlah' => [
            'rules' => 'required',
        ],
        'total_harga' => [
            'rules' => 'required',
        ],
        'alamat' => [
            'rules' => 'required',
        ],
        'ongkir' => [
            'rules' => 'required',
        ],
    ];


    public $login_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 8 karakter',
        ],
        'password' => [
            'required' => '{field} Harus Diisi',
        ],
    ];

    public $stuff = [
        'nama' => [
            'rules' => 'required|min_length[3]',
        ],
        'harga' => [
            'rules' => 'required|is_natural',
        ],
        'nama_jastip' => [
            'rules' => 'required|min_length[5]',
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]',
        ],
    ];

    public $stuff_errors = [
        'nama' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimum 3 Karakter'
        ],
        'harga' => [
            'required' => '{field} Harus Diisi',
            'is_natural' => '{field} Tidak Boleh Negatif'
        ],
        'nama_jastip' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimum 5 Karakter'
        ],
        'gambar' => [
            'uploaded' => '{field} Harus Di Upload',
        ],
    ];

    public $stuffupdate = [
        'nama' => [
            'rules' => 'required|min_length[3]',
        ],
        'nama_jastip' => [
            'rules' => 'required|min_length[5]',
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]',
        ],
    ];

    public $stuffupdate_errors = [
        'nama' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimum 3 Karakter'
        ],
        'harga' => [
            'required' => '{field} Harus Diisi',
            'is_natural' => '{field} Tidak Boleh Negatif'
        ],
        'nama_jastip' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimum 5 Karakter'
        ],
    ];

    public $komentar = [
        'komentar' => [
            'rules' => 'required',
        ]
    ];
}
