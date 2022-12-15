<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['name' => "bpract","email"=>"admin@bpract.com","password"=>bcrypt('password')]);
        User::firstOrCreate(['name' => "sneha","email"=>"sneha@gmail.com","password"=>bcrypt('123456')]);

    }
}
