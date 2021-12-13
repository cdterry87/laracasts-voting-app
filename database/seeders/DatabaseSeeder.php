<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(['name' => 'Category 1']);
        Category::factory()->create(['name' => 'Category 2']);
        Category::factory()->create(['name' => 'Category 3']);
        Category::factory()->create(['name' => 'Category 4']);

        Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);
        Status::factory()->create(['name' => 'Considering', 'classes' => 'status--considering']);
        Status::factory()->create(['name' => 'In Progress', 'classes' => 'status--in-progress']);
        Status::factory()->create(['name' => 'Implemented', 'classes' => 'status--implemented']);
        Status::factory()->create(['name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory(30)->create();
    }
}
