<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Password is set via DB to avoid double-hashing with model cast.
     */
    public function run(): void
    {
        $email = 'ibrahimyousfi000@gmail.com';
        $password = 'ibrahimyousfi000@gmail.com';

        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => 'Admin', 'password' => $password]
        );

        // Update password directly in DB (single bcrypt hash) so login works
        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($password),
        ]);

        $this->command->info('Admin user created/updated.');
        $this->command->info('Email: ' . $email);
        $this->command->info('Password: ' . $password);
    }
}
