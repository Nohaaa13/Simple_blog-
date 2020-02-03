<?php

use App\Entity\User\Role;
use Illuminate\Database\Seeder;
use App\Entity\User\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table((new User)->getTable())->delete();
        User::create(['id' => 1, 'name' => 'admin', 'email' => 'admin@admin.admin','role_id' => Role::ADMIN,  'remember_token' => Str::random(10), 'password' => bcrypt('password')] );
        User::create(['id' => 2, 'name' => 'ivan ivanov', 'email' => 'test@test.test','role_id' => Role::CLIENT,  'remember_token' => Str::random(10), 'password' => bcrypt('password')] );

    }

}
