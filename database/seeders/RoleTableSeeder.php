<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['administrator', 'Administrator', 'web'],
            ['adminbkd', 'Admin BKD', 'web'],
            ['adminopd', 'Admin OPD', 'web'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name'        => $role[0],
            ],[
                'name'        => $role[0],
                'description' => $role[1],
                'guard_name'  => $role[2],
            ]);
        }
    }
}
