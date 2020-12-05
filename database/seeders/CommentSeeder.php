<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake_comment = ['Great posts!', 'I love it!', 'Hmm, i wonder ...', "Wow, that's what i'm looking for !"];
        for($i=0; $i<=10; $i++){
            DB::table('comments')->insert([
                'posts_id'    =>  rand(1,10),
                'comment'     =>  $fake_comment[rand(0,3)],
                'created_by'  =>  rand(1,10),
            ]);
        }
    }
}
