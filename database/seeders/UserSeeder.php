<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin user

        return User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
        ]);

    }
}
