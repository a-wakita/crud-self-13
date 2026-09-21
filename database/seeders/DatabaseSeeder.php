<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['name' => '仕事']);
        Category::create(['name' => 'プライベート']);
        Category::create(['name' => 'その他']);
    }
}