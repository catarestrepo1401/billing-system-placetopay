<?php

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
        factory(\App\Models\User::class)->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@demo.com',
            'password' => 'admin',
        ]);

        factory(\App\Models\User::class, 25)->create();
    }
}
