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
        $user = User::create([
            'name' => 'Admin',
            'email_verified_at' => now(),
            'email' => 'reivaj_31@hotmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRoles('admin');
        $user->save();
    }
}
