<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name'=>'食事'
            ]);
        DB::table('categories')->insert([
            'name'=>'歴史'
            ]);
        DB::table('categories')->insert([
            'name'=>'自然'
            ]);
        DB::table('categories')->insert([
            'name'=>'アート'
            ]);
        DB::table('categories')->insert([
            'name'=>'文化'
            ]);
        DB::table('categories')->insert([
            'name'=>'その他'
            ]);
    }
}
