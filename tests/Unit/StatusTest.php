<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_count_of_each_status()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'status--considering']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'status--in-progress']);
        $statusImplemented = Status::factory()->create(['name' => 'Implemented', 'classes' => 'status--implemented']);
        $statusClosed = Status::factory()->create(['name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
        ]);

        $this->assertEquals(16, Status::getCounts()['all_statuses']);
        $this->assertEquals(3, Status::getCounts()['open']);
        $this->assertEquals(2, Status::getCounts()['considering']);
        $this->assertEquals(4, Status::getCounts()['in_progress']);
        $this->assertEquals(5, Status::getCounts()['implemented']);
        $this->assertEquals(2, Status::getCounts()['closed']);
    }
}
