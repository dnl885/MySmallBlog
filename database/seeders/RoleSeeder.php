<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach(RoleConstants::ROLE_KEYS_TO_NAMES as $k=>$v){
            Role::create(['role_key'=>$k,'role_name'=>$v]);
        }
    }
}
