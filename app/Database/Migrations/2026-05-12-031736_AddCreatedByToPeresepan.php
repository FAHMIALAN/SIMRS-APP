<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedByToPeresepan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peresepan', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'dokter_id'
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('peresepan', 'peresepan_user_id_foreign');
        $this->forge->dropColumn('peresepan', 'user_id');
    }
}
