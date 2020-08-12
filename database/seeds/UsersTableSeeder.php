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
        $user = User::create([
            'name' => 'Admin1',
            'email_verified_at' => now(),
            'email' => 'javieracabrera14@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRoles('admin');
        $user->save();
        $user = User::create([
            'name' => 'Admin2',
            'email_verified_at' => now(),
            'email' => 'iburgos16@alumnos.utalca.cl',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRoles('admin');
        $user->save();
    }
}
