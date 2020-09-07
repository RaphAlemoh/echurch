<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Admin User';
        $role_admin->save();
        
        $role_staff = new Role();
        $role_staff->name = 'staff';
        $role_staff->description = 'A Staff User';
        $role_staff->save();

        $role_customer = new Role();
        $role_customer->name = 'user';
        $role_customer->description = 'A user';
        $role_customer->save();
    }
}
