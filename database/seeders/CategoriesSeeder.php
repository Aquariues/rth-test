<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=7; $i++){
        	DB::table('categories')->insert([
        		'name'			=>	'Categories '.$i,
        		'created_by'	=>	rand(1,50),
        	]);
        }
    }
}
