<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Create regular users with unique usernames
        $users = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'username' => 'john_doe'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'username' => 'jane_smith'],
            ['name' => 'Bob Wilson', 'email' => 'bob@example.com', 'username' => 'bob_wilson'],
            ['name' => 'Alice Brown', 'email' => 'alice@example.com', 'username' => 'alice_brown'],
            ['name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'username' => 'charlie_davis'],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'username' => $userData['username'],
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                ]
            );
        }

        // Call other seeders
        $this->call([
            BookSeeder::class,
        ]);
    }
}
