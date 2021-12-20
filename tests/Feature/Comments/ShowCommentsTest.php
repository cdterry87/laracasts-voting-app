<?php

namespace Tests\Feature\Comments;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function idea_comments_livewire_components_render()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-comments')
            ->assertSeeLivewire('idea-comment');
    }

    /** @test */
    public function no_comments_shows_appropriate_message()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSee('No comments yet');
    }

    /** @test */
    public function list_of_comments_shows_on_idea_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment'
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my second comment'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeInOrder(['This is my first comment', 'This is my second comment'])
            ->assertSee('2 comments');
    }

    /** @test */
    public function comments_count_shows_correctly_on_index_page()
    {
        $idea = Idea::factory()->create();

        $commentOne = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment'
        ]);

        $commentTwo = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my second comment'
        ]);

        $this->get(route('idea.index'))
            ->assertSee('2 comments');
    }
}
