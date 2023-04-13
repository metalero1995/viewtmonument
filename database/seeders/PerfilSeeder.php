<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert([
            'PerfilID' => '1',
            'descripcion' => 'Administrador',
            'created_at' => '2022-10-28 00:30:20',
            'updated_at' => '2022-10-28 00:30:20'
        ]);

        DB::table('perfiles')->insert([
            'PerfilID' => '2',
            'descripcion' => 'Usuario',
            'created_at' => '2022-10-28 00:30:20',
            'updated_at' => '2022-10-28 00:30:20'
        ]);

    }
}
