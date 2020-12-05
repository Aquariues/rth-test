<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=10; $i++){
            DB::table('posts')->insert([
                'categories_id'   =>  rand(1,10),
                'title'           =>  Str::random(20),
                'contents'        =>  Str::random(20),
                'count_view'      =>  rand(1,100),
                'created_by'      =>  rand(1,10),
            ]);
        }
    }
}
