<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin  = Role::where('name', 'admin')->first();
        $role_staff  = Role::where('name', 'staff')->first();
        $role_customer  = Role::where('name', 'customer')->first();

        $admin = new User();
        $admin->first_name = 'Church';
        $admin->last_name = 'Admin';
        $admin->name = $admin->last_name .' '. $admin->first_name;
        $admin->email = 'echurch@echurch.com';
        $admin->phone = '0809778778';
        $admin->password = bcrypt('echurch123');
        $admin->email_verified_at = NOW();
        $admin->save();
        $admin->roles()->attach($role_admin);


        $staff = new User();
        $staff->first_name = 'echurch';
        $staff->last_name = 'Staff';
        $staff->name = $staff->last_name .' '. $staff->first_name;
        $staff->email = 'staff1@echurch.com';
        $staff->phone = '08099897489';
        $staff->password = bcrypt('user123');
        $staff->email_verified_at = NOW();
        $staff->save();
        $staff->roles()->attach($role_staff);


        $customer = new User();
        $customer->first_name = 'eChurch';
        $customer->last_name = 'user';
        $customer->name = $customer->last_name .''. $customer->first_name;
        $customer->email = 'user@echurch.com';
        $customer->phone = '08099897489';
        $customer->password = bcrypt('user123');
        $customer->email_verified_at = NOW();
        $customer->save();
        $customer->roles()->attach($role_customer);
    }
}
