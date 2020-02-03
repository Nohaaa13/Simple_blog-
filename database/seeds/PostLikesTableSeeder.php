<?php


use App\Entity\PostLikes;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostLikesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table((new PostLikes())->getTable())->delete();
        PostLikes::create(['id' => 1, 'user_id' => 1 ,'post_id' => 1 ,'like'=> 1]  );
        PostLikes::create(['id' => 2, 'user_id' => 2 ,'post_id' => 1 ,'like'=> 1]  );
        PostLikes::create(['id' => 3, 'user_id' => 2 ,'post_id' => 2 ,'like'=> 1]  );

    }

}
