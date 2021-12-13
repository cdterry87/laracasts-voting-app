<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeaShow;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_idea_show_livewire_component()
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

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-show');
    }

    /** @test */
    public function show_page_correctly_receives_votes()
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

        $this->get(route('idea.show', $idea))
            ->assertViewHas('votes', 2);
    }

    /** @test */
    public function votes_count_shows_correctly_on_show_page_livewire_component()
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

        Livewire::test(IdeaShow::class, [
            'idea' => $idea,
            'votes' => 5
        ])
        ->assertSet('votes', 5);
        // ->assertSeeHtml('<div class="text-xl leading-snug">5</div>')
        // ->assertSeeHtml('<div class="text-sm font-bold leading-none">5</div>');
    }

    /** @test */
    public function user_who_is_logged_in_shows_voted_if_idea_is_already_voted_for()
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

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votes' => 5
            ])
            ->assertSet('hasVoted', true)
            ->assertSee('Voted');
    }

     /** @test */
     public function user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote()
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

        Livewire::test(IdeaShow::class, [
                'idea' => $idea,
                'votes' => 5
            ])
            ->call('vote')
            ->assertRedirect(route('login'));
     }

    /** @test */
    public function user_who_is_logged_in_can_vote_for_idea_show_page()
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

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votes' => 5
            ])
            ->call('vote')
            ->assertSet('hasVoted', true)
            ->assertSet('votes', 6)
            ->assertSee('Voted');

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);
    }

    public function user_who_is_logged_in_can_remove_vote_for_idea()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'Description for my first idea',
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $ideaWithVotes,
                'votes' => 5,
            ])
            ->call('vote')
            ->assertSet('votes', 4)
            ->assertSet('hasVoted', false)
            ->assertSee('Vote')
            ->assertDontSee('Voted');

        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);
    }
}
