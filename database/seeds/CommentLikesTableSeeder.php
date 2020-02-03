<?php


use App\Entity\CommentLikes;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CommentLikesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table((new CommentLikes())->getTable())->delete();
        CommentLikes::create(['id' => 1,'user_id' => 1 ,'comment_id' => 1 ,'like'=> 1]  );
        CommentLikes::create(['id' => 2,'user_id' => 2 ,'comment_id' => 2 ,'like'=> 1]  );


    }

}
