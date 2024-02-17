<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            'name'=>'北仏',
            ]);
        DB::table('regions')->insert([
            'name'=>'東仏',
            ]);
        DB::table('regions')->insert([
            'name'=>'南仏',
            ]);
        DB::table('regions')->insert([
            'name'=>'西仏',
            ]);
        DB::table('regions')->insert([
            'name'=>'中部',
            ]);
    }
}
