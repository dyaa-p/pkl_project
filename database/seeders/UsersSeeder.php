<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        \App\Models\User::create([
            'name' => 'Dyaa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia'),
            'role' => 'admin'
        ]);
        
        \App\Models\User::create([
            'name' => 'Putri',
            'email' => 'putri@gmail.com',
            'password' => bcrypt('rahasia'),
            'role' => 'user'
        ]);

        \App\Models\User::create([
            'name' => 'Kirana',
            'email' => 'kirana@gmail.com',
            'password' => bcrypt('rahasia'),
            'role' => 'user'
        ]);
    }
}
