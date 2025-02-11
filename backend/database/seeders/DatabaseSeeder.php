<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\User;
use Database\Factories\MachineFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@sprayapp.com',
            'password' => bcrypt('12345')
        ]);

        Machine::factory()->count(10)->create();
    }
}
