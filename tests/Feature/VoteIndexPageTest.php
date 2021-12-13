<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeaIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_idea_show_livewire_component()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first idea',
            'description' => 'My first idea description',
        ]);

        $this->get(route('idea.index', $idea))
            ->assertSeeLivewire('idea-index');
    }

    /** @test */
    public function index_page_correctly_receives_votes()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first idea',
            'description' => 'My first idea description',
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Vote::factory()->create([
            'user_id' => $user2->id,
            'idea_id' => $idea->id,
        ]);

        $this->get(route('idea.index', $idea))
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->first()->votes_count == 2;
            });
    }

    /** @test */
    public function votes_count_shows_correctly_on_index_page_livewire_component()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Category']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first idea',
            'description' => 'My first idea description',
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votes' => 5
        ])
        ->assertSet('votes', 5)
        ->assertSeeHtml('<div class="font-semibold text-2xl">5</div>')
        ->assertSeeHtml('<div class="text-sm font-bold leading-none">5</div>');
    }
}
