<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usuario con el rol1 super-admin
        $admin = User::create([
            'identification' => '123',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@demo.com',
            'password' => 'admin',
        ]);
        $admin->assignRole('super-admin');

        // usuario con el rol2 moderator
        $moderator = User::create([
            'identification' => '456',
            'first_name' => 'Moderator',
            'last_name' => 'User',
            'email' => 'moderator@demo.com',
            'password' => 'moderatoruser',
        ]);
        $moderator->assignRole('moderator');

        // usuario con el rol3 guess
        $guess = User::create([
            'identification' => '789',
            'first_name' => 'Guess',
            'last_name' => 'User',
            'email' => 'guess@demo.com',
            'password' => 'guessuser'
        ]);
        $guess->assignRole('guess');

        factory(\App\Models\User::class, 20)->create();
    }
}
