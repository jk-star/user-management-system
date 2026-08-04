<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'status'   => 'active',
            ],

            [
                'name'     => 'Test User',
                'email'    => 'user@example.com',
                'password' => password_hash('User@123', PASSWORD_DEFAULT),
                'role'     => 'user',
                'status'   => 'active',
            ],
        ];

        $this->db
            ->table('users')
            ->insertBatch($data);
    }
}
