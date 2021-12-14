<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\StatusFilters;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_constains_status_filters_livewire_component()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function show_page_contains_status_filters_livewire_component()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function shows_correct_status_count()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusClosed = Status::factory()->create(['id' => 5, 'name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Closed (2)');
    }


    /** @test */
    public function filtering_works_when_query_string_in_place()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'status--considering']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'status--in-progress']);

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

        // $response = $this->get(route('idea.index', [
        //     'status' => 'Considering'
        // ]));
        // $response->assertSuccessful();
        // $response->assertSee('status--considering', false);
        // $response->assertDontSee('status--in-progress', false);

        // $response = $this->get(route('idea.index', [
        //     'status' => 'In Progress'
        // ]));
        // $response->assertSuccessful();
        // $response->assertDontSee('status--considering', false);
        // $response->assertSee('status--in-progress', false);

        Livewire::withQueryParams(['status' => 'In Progress'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->status->name === 'In Progress';
            });
    }

    /** @test */
    public function show_page_does_not_show_selected_status()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusClosed = Status::factory()->create(['id' => 5, 'name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $response = $this->get(route('idea.show', [
            'idea' => $idea
        ]));

        $response->assertDontSee('border-blue text-gray-900', false);
    }

    /** @test */
    public function index_page_shows_selected_status()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category 1']);
        $statusClosed = Status::factory()->create(['id' => 5, 'name' => 'Closed', 'classes' => 'status--closed']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusClosed->id,
            'title' => 'My First Idea',
            'description' => 'My first idea description',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSee('border-blue text-gray-900', false);
    }
}
