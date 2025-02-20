<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'test@example.com',
                'name' => 'Test_Name',
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ],
            [
                'email' => 'test_non_verified@example.com',
                'name' => 'Test_Name_2',
                'password' => Hash::make('password'),
                'email_verified_at' => null
            ],
        ];
        foreach ($users as $user) {
            User::query()
                ->firstOrCreate(
                    [
                        'email' => $user['email'],
                    ],
                    [
                        'name' => $user['name'],
                        'password' => $user['password'],
                        'email_verified_at' => $user['email_verified_at'],
                    ]);
        }
    }
}
