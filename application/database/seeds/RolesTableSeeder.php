<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = 'admin';
        $role->save();

        $role = new Role;
        $role->name = 'patient';
        $role->save();

        $role = new Role;
        $role->name = 'conventants';
        $role->save();
    
        $role = new Role;
        $role->name = 'doctor';
        $role->save();

        $user = new User;
        $user->name = 'Admin';
        $user->email = 'serbann.alexandruu@yahoo.com';
        $user->password = bcrypt('password');
        $user->role_id = 1;
        $user->save();
    }
}
