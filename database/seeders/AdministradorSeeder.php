<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'PerfilID' => '1',
            'name' => 'Eliezer Castillo',
            'email' => 'ecastilosam@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => '2022-11-08 00:30:20',
            'updated_at' => '2022-11-08 00:30:20'            
        ]);
    }
}
