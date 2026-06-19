<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');
        $now = now();
        
        \Illuminate\Support\Facades\DB::insert("
            INSERT INTO users (name, email, password, role, created_at, updated_at) 
            VALUES ('Super Admin', 'superadmin@gmail.com', '{$password}', 'superadmin', '{$now}', '{$now}')
            ON DUPLICATE KEY UPDATE password = '{$password}', updated_at = '{$now}'
        ");
    }
}
