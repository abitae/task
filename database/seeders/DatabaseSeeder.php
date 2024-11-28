<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Abel Arana',
            'email' => 'abel.arana@hotmail.com',
            'password' => bcrypt('lobomalo123'),
        ]);
        Task::factory(100)->create();
    }
}
