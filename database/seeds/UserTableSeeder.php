<?php

use Illuminate\Database\Seeder;
use SimpleLance\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('simplelance'),
        ));

        User::create(array(
            'email'    => 'user@user.com',
            'username' => 'user',
            'password' => Hash::make('simplelance'),
        ));
    }
}
