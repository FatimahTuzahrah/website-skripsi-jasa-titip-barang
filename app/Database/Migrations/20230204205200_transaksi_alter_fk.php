<?php

namespace App\Database\Migrations;

class TransaksiAlterFk extends \CodeIgniter\Database\Migration
{

    public function up()
    {

        $this->forge->dropForeignKey('transaksi', 'transaksi_id_stuff_foreign');
        $this->forge->dropForeignKey('transaksi', 'transaksi_id_user_foreign');

        $this->forge->addColumn('transaksi', [
            'CONSTRAINT transaksi_id_user_foreign FOREIGN KEY(id_user) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);

        $this->forge->addColumn('transaksi', [
            'CONSTRAINT transaksi_id_stuff_foreign FOREIGN KEY(id_stuff) REFERENCES stuff(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);
    }
    public function down()
    {
        $this->forge->addColumn('transaksi', [
            'CONSTRAINT transaksi_id_user_foreign FOREIGN KEY(id_user) REFERENCES user(id)',
        ]);

        $this->forge->addColumn('transaksi', [
            'CONSTRAINT transaksi_id_stuff_foreign FOREIGN KEY(id_stuff) REFERENCES stuff(id)',
        ]);
    }
}
