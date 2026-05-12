<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@simrs.local',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role'     => 'admin',
        ];

        // Simple check to avoid duplicate admin
        $exists = $this->db->table('users')->where('email', 'admin@simrs.local')->countAllResults();
        if ($exists == 0) {
            $this->db->table('users')->insert($data);
        }
    }
}
