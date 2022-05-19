<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'numero_CIN'=>'12345678',
            'email'=>'etablissement@gmail.com',
            'isActive'=>false,
            'password' => bcrypt('12345678'),
        ]);
    }
}