<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'ibrahimyousfi000@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('ibrahimyousfi000@gmail.com'),
            ]
        );

        // Update password if user exists
        if ($user->wasRecentlyCreated === false) {
            $user->password = Hash::make('ibrahimyousfi000@gmail.com');
            $user->save();
        }

        $this->command->info('Admin user created/updated successfully!');
        $this->command->info('Email: ibrahimyousfi000@gmail.com');
        $this->command->info('Password: ibrahimyousfi000@gmail.com');
    }
}
