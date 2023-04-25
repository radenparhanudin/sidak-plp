<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['Administrator', 'administrator', 'administrator@mail.com', 'password', 'administrator'],
        ];

        foreach ($users as $user) {
            $cekUser = User::whereUsername($user[1])->first();
            if(!$cekUser){
                $newUser = User::create([
                    'name'     => $user[0],
                    'username' => $user[1],
                    'email'    => $user[2],
                    'password' => Hash::make($user[3]),
                ]);

                $newUser->assignRole($user[4]);
            }
        }
    }
}
