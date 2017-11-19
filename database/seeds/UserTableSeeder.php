<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mario Mitchelle',
            'email' => 'mario.mitchelle65@example.com',
            'password' => bcrypt('abcd1234'),
        ]);
        DB::table('users')->insert([
            'name' => 'Derrick Long',
            'email' => 'derrick.long17@example.com',
            'password' => bcrypt('abcd1234'),
        ]);

    }
}
