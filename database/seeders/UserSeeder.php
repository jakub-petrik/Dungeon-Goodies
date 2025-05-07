<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nickname' => 'STheCheatCode',
            'email' => 'simonmizerak1@gmail.com',
            'password' => Hash::make('ahojslovensko'),
            'first_name' => 'Simon',
            'last_name' => 'Mizerak',
            'admin' => TRUE,
        ]);

        User::create([
            'nickname' => 'DocentP',
            'email' => 'jakubpetrik@gmail.com',
            'password' => Hash::make('ahojslovensko'),
            'first_name' => 'Jakub',
            'last_name' => 'Petrik',
            'admin' => TRUE,
        ]);
    }
}
