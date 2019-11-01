<?php

use App\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) {
            User::create([
                'name' => 'test' .$i,
                'email' => 'test' .$i .'@test.com',
                'password' => Hash::make('00000000'),
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
