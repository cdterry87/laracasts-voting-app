<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ideas_list_shows_on_main_page()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $categoryTwo = Category::factory()->create([
            'name' => 'Category Two',
        ]);

        $statusOpen = Status::factory()->create([
            'name' => 'Open',
            'classes' => 'status--open'
        ]);

        $statusClosed = Status::factory()->create([
            'name' => 'Closed',
            'classes' => 'status--closed'
        ]);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'Idea One',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description One',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'Idea Two',
            'category_id' => $categoryTwo->id,
            'status_id' => $statusClosed->id,
            'description' => 'Description Two',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($categoryOne->name);
        $response->assertSee('status--open');
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryTwo->name);
        $response->assertSee('status--closed');
    }

    /** @test */
    public function idea_shows_correctly_on_show_page()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $statusOpen = Status::factory()->create([
            'name' => 'Open',
            'classes' => 'status--open'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'Idea One',
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description One',
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }

    /** @test */
    public function ideas_pagination_works()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $statusOpen = Status::factory()->create([
            'name' => 'Open',
            'classes' => 'status--open'
        ]);

        Idea::factory(Idea::PAGINATION_COUNT + 1)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'My First Idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'My Eleventh Idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);

        $response = $this->get(route('idea.index', ['page' => 2]));

        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaEleven->title);
    }

    /** @test */
    public function same_idea_title_different_slugs()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $statusOpen = Status::factory()->create([
            'name' => 'Open',
            'classes' => 'status--open'
        ]);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description One',
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description Two',
        ]);

        $response = $this->get(route('idea.show', $ideaOne));
        $response->assertSuccessful();
        $this->assertTrue(request()->path() === 'ideas/my-first-idea');

        $response = $this->get(route('idea.show', $ideaTwo));
        $response->assertSuccessful();
        $this->assertTrue(request()->path() === 'ideas/my-first-idea-2');
    }
}
