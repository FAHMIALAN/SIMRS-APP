<?php

   namespace App\Database\Migrations;
   use CodeIgniter\Database\Migration;

   class Pasien extends Migration
   {
       public function up()
       {
           $this->forge->addField([
               'id_pasien' => [
                   'type'           => 'INT',
                   'constraint'     => 11,
                   'unsigned'       => true,
                   'auto_increment' => true,
               ],
               'nomor_rm' => [
                   'type'       => 'VARCHAR',
                   'constraint' => '20',
                   'unique'     => true,
               ],
               'nama' => [
                   'type'       => 'VARCHAR',
                   'constraint' => '100',
               ],
               'alamat' => [
                   'type' => 'TEXT',
                   'null' => true,
               ],
               'created_at' => [
                   'type' => 'DATETIME',
                   'null' => true,
               ],
               'updated_at' => [
                   'type' => 'DATETIME',
                   'null' => true,
               ]
           ]);
           $this->forge->addKey('id_pasien', true);
           $this->forge->createTable('pasien');
       }

       public function down()
       {
           $this->forge->dropTable('pasien');
       }
   }