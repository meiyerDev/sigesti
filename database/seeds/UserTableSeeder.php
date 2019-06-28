<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_boss = Role::where('name', 'boss')->first();

        $user = new User();
        $user->name = 'Tecnico';
        $user->user = 'tecnico';
        $user->password = bcrypt('root');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Root';
        $user->user = 'root';
        $user->password = bcrypt('root');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Jefe Tecnico';
        $user->user = 'boss';
        $user->password = bcrypt('root');
        $user->save();
        $user->roles()->attach($role_boss);
     }
}
