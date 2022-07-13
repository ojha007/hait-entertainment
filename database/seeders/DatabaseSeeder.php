<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@hait.com.au',
        ], [
            'name' => 'Admin',
            'email' => 'admin@hait.com.au',
            'phone' => '0001',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@123')
        ]);
        // User::factory(10)->create();
    }
}
