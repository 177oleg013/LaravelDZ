<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Адміністратор',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $user = User::factory()->create([
            'name' => 'Звичайний користувач',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        Note::factory()->count(3)->for($admin)->create();
        Note::factory()->count(4)->for($user)->create();
    }
}
