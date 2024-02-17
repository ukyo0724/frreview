<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id'=>1,
            'region_id'=>1,
            'title'=>'france',
            'body'=>'I enjoyed France',
            'city'=>'Paris',
            'status'=>1,
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            ]);
    }
}
