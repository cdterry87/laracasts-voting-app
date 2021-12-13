<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
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
        User::factory()->create([
            'name' => 'Chase',
            'email' => 'chase.terry87@gmail.com'
        ]);

        User::factory()->count(19)->create();

        Category::factory()->create(['name' => 'Category 1']);
        Category::factory()->create(['name' => 'Category 2']);
        Category::factory()->create(['name' => 'Category 3']);
        Category::factory()->create(['name' => 'Category 4']);

        Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);
        Status::factory()->create(['name' => 'Considering', 'classes' => 'status--considering']);
        Status::factory()->create(['name' => 'In Progress', 'classes' => 'status--in-progress']);
        Status::factory()->create(['name' => 'Implemented', 'classes' => 'status--implemented']);
        Status::factory()->create(['name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory(100)->create();

        // Generate unique votes for each idea. Ensure idea_id and user_id are unique for each row.
        foreach(range(1, 20) as $user_id) {
            foreach(range(1, 100) as $idea_id) {
                if ($idea_id % 2 == 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id,
                    ]);
                }
            }
        }
    }
}
