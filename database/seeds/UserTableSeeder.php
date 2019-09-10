<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
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
      
      $user = new User();
      $user->name = 'user';
      $user->email = 'user@mail.com';
      $user->password = bcrypt('123');
      $user->save();

      $user->roles()->attach($role_user);

      $user_admin = new User();
      $user_admin->name = 'admin';
      $user_admin->email = 'admin@mail.com';
      $user_admin->password = bcrypt('123');
      $user_admin->save();

      $user->roles()->attach($role_admin);
    }
}

