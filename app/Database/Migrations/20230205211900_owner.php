<?php

namespace App\Database\Migrations;

class User extends \CodeIgniter\Database\Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_stuff' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'nama_jastip' => [
                'type' => 'TEXT',
            ],
            'alamat_jastip' => [
                'type' => 'TEXT',
            ],
            'jenis_jastip' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tempat_transit' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_owner' => [
                'type' => 'TEXT',
            ],
            'gambar' => [
                'type' => 'TEXT',
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_date' => [
                'type' => 'DATETIME',
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'updated_date' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('owner');
    }
    public function down()
    {
        $this->forge->dropTable('owner');
    }
}
