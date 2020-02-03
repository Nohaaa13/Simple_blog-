<?php


use App\Entity\Posts;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{

    public function run()
    {
        DB::table((new Posts())->getTable())->delete();
        Posts::create(['id' => 1, 'title' => 'First title', 'body' => 'Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text. Simple text.','user_id' => 2 ,'likes'=> 2]  );
        Posts::create(['id' => 2, 'title' => 'First title', 'body' => ' Fast text. Fast text. Fast text. Fast text. Fast text. Fast text.','user_id' => 2 ,'likes'=> 1]  );

    }

}
