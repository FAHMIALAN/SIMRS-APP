<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPasien extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pasien', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id_pasien'
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
        // Note: For existing tables, adding FK sometimes requires raw SQL or specific order
    }

    public function down()
    {
        $this->forge->dropForeignKey('pasien', 'pasien_user_id_foreign');
        $this->forge->dropColumn('pasien', 'user_id');
    }
}
