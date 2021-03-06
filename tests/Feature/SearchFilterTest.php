<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search_works_when_more_than_three_characters()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea',
            'description' => 'Description for my second idea',
        ]);

        $ideaThird = Idea::factory()->create([
          'user_id' => $user->id,
          'category_id' => $categoryOne->id,
          'status_id' => $statusOpen->id,
          'title' => 'My Third Idea',
          'description' => 'Description for my third idea',
      ]);

      Livewire::test(IdeasIndex::class)
        ->set('search', 'Third')
        ->assertViewHas('ideas', function ($ideas) {
            return $ideas->count() === 1
              && $ideas->first()->title === 'My Third Idea';
        });
    }

    /** @test */
    public function does_not_perform_search_if_less_than_three_characters()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea',
            'description' => 'Description for my second idea',
        ]);

        $ideaThird = Idea::factory()->create([
          'user_id' => $user->id,
          'category_id' => $categoryOne->id,
          'status_id' => $statusOpen->id,
          'title' => 'My Third Idea',
          'description' => 'Description for my third idea',
      ]);

      Livewire::test(IdeasIndex::class)
        ->set('search', 'ab')
        ->assertViewHas('ideas', function ($ideas) {
            return $ideas->count() === 3;
        });
    }

    /** @test */
    public function search_works_correctly_with_category_filters()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);
        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My Second Idea',
            'description' => 'Description for my second idea',
        ]);

        $ideaThird = Idea::factory()->create([
          'user_id' => $user->id,
          'category_id' => $categoryTwo->id,
          'status_id' => $statusOpen->id,
          'title' => 'My Third Idea',
          'description' => 'Description for my third idea',
      ]);

      Livewire::test(IdeasIndex::class)
        ->set('search', 'Idea')
        ->set('category', 'Category 1')
        ->assertViewHas('ideas', function ($ideas) {
            return $ideas->count() === 2;
        });
    }
}
