<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
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
      $role_admin = Role::where('name', 'admin')->first();

      $user_admin = new User();
      $user_admin->name = 'admin';
      $user_admin->email = 'admin@mail.com';
      $user_admin->password = bcrypt('test123');
      $user_admin->role_id = $role_admin->id;
      $user_admin->save();
    }
}