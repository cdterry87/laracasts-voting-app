<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ideas_list_shows_on_main_page()
    {
        $categoryOne = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $categoryTwo = Category::factory()->create([
            'name' => 'Category Two',
        ]);

        $ideaOne = Idea::factory()->create([
            'title' => 'Idea One',
            'category_id' => $categoryOne->id,
            'description' => 'Description One',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'Idea Two',
            'category_id' => $categoryTwo->id,
            'description' => 'Description Two',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($categoryOne->name);
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryTwo->name);
    }

    /** @test */
    public function idea_shows_correctly_on_show_page()
    {
        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $idea = Idea::factory()->create([
            'title' => 'Idea One',
            'category_id' => $category->id,
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
        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        Idea::factory(Idea::PAGINATION_COUNT + 1)->create([
            'category_id' => $category->id
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'My First Idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'My Eleventh Idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaEleven->title);

        $response = $this->get(route('idea.index', ['page' => 2]));

        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);
    }

    /** @test */
    public function same_idea_title_different_slugs()
    {
        $category = Category::factory()->create([
            'name' => 'Category One',
        ]);

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'category_id' => $category->id,
            'description' => 'Description One',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My First Idea',
            'category_id' => $category->id,
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
