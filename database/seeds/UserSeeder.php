<?php

use App\User;
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
        User::truncate();

        $admin = new User;
        $admin->name = 'Federico';
        $admin->email = 'f.nicolas.alonso@gmail.com';
        $admin->password = 'Teresa1950';
        $admin->save();
    }
}
