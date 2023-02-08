<?php namespace App\Database\Migrations; 

class Stuff extends \CodeIgniter\Database\Migration{

	public function up(){
		$this->forge->addField([
			'id'=>[
				'type'=>'INT',
				'constraint'=>11,
				'unsigned'=>TRUE,
				'auto_increment'=>TRUE
			],
            'id_owner'=>[
                'type'=>'INT',
				'constraint'=>11,
            ],
			'nama'=>[
				'type'=>'TEXT',
			],
			'harga'=>[
				'type'=>'INT',
				'constraint'=>11,
			],
			'stok'=>[
				'type'=>'INT',
				'constraint'=>11,	
			],
			'gambar'=>[
				'type'=>'TEXT',
			],
            'nama_jastip'=>[
                'type'=>'TEXT',
            ],
            'jenis_barang'=>[
                'type'=>'VARCHAR',
				'constraint'=>'100',
            ],
            'alamat_jastip'=>[
                'type'=>'TEXT',
            ],
			'created_by'=>[
				'type' => 'INT',
				'constraint' => 11,
			],
			'created_date'=>[
				'type' => 'DATETIME',
			],
			'updated_by'=>[
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,
			],
			'updated_date'=>[
				'type'=>'DATETIME',
				'null'=>TRUE,
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('stuff');
	}

	public function down(){
		$this->forge->dropTable('stuff');
	}
}
