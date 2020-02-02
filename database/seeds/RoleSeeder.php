<?php

use Illuminate\Database\Seeder;
use App\Entity\User\Role;

class RoleSeeder extends Seeder
{

    public function run()
    {
        DB::table((new Role)->getTable())->delete();
        Role::create(['id' => Role::ADMIN, 'name' => 'Адміністратор']);
        Role::create(['id' => Role::CLIENT, 'name' => 'Клієнт']);
    }

}
