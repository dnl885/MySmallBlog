<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('p@$$w0rd0123'),
            'email_verified_at'=>new \DateTime()
        ]);

        $role = Role::where('role_key',RoleConstants::ROLE_ADMIN)->first();

        if(!$role){
            exit('Admin role does not exist. Run the RoleSeeder first!');
        }

        $user->save();

        $role->users()->attach($user);
    }
}
