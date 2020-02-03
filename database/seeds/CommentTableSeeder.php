<?php


use App\Entity\Comments;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table((new Comments())->getTable())->delete();
        Comments::create(['id' => 1, 'body' => 'Fast comment Fast comment Fast comment Fast comment Fast comment','user_id' => 2 ,'post_id' => 2 ,'likes'=> 1]  );
        Comments::create(['id' => 2,  'body' => 'Fast comment','user_id' => 2 ,'post_id' => 2 ,'likes'=> 1]  );

    }

}
