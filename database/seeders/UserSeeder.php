<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'name' => 'MM',
            'email' => 'mm@test.com',
            'password' => bcrypt('12312312'),
        ];

        User::upsert($users, ['email'], ['name', 'password']);
    }
}
