<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ContentStarterSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ContentStarterSeeder::class,
            ContentAdditionsSeeder::class,
            ContentSeeder::class,
            InitialContentSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@esport.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
