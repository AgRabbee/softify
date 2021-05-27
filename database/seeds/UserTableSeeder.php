<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'system admin';
        $admin->email = 'admin@system.com';
        $admin->password = bcrypt('123456');
        $admin->user_type= '1';
        $admin->user_status = '1';
        $admin->save();

        $user = new User;
        $user->name = 'Ag Rabbee';
        $user->email = 'a@b.com';
        $user->password = bcrypt('123456');
        $user->user_status = '1';
        $user->save();

    }
}
