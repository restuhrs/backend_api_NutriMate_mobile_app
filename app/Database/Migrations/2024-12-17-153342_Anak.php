<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anak' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'orang_tua' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'umur' => [
                'type'       => 'INT',
                'constraint' => 3,
                'null'       => true, // optional jika perlu null
            ],
            'berat_badan' => [
                'type'       => 'FLOAT',
                'null'       => true, // optional jika perlu null
            ],
            'tinggi_badan' => [
                'type'       => 'FLOAT',
                'null'       => true, // optional jika perlu null
            ],
            'lingkar_lengan' => [
                'type'       => 'FLOAT',
                'null'       => true, // optional jika perlu null
            ],
            'waktu_update' => [
                'type' => 'DATETIME',
                'null' => true, // optional jika perlu null
            ],
        ]);

        // Menambahkan Primary Key
        $this->forge->addKey('id_anak', true);

        // Menambahkan Foreign Key
        $this->forge->addForeignKey('orang_tua', 'user', 'id', 'CASCADE', 'CASCADE');

        // Membuat tabel
        $this->forge->createTable('anak');
    }

    public function down()
    {
        // Drop tabel jika di-rollback
        $this->forge->dropTable('anak');
    }
}