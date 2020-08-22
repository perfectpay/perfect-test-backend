<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_status')->insert([
            ['name' => 'Aprovado', 'slug' => 'aprovado'],
            ['name' => 'Cancelado', 'slug' => 'cancelado'],
            ['name' => 'Devolvido', 'slug' => 'devolvido'],
        ]);
    }
}
