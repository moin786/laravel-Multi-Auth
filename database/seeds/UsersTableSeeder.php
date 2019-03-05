<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'moinuddin7@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'superadmin'
        ]);
    }
}
