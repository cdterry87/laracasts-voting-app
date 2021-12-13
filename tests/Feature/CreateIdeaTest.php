<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\CreateIdea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_idea_form_does_not_show_when_logged_out()
    {
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee('Please login to add an idea.');
        $response->assertDontSee('Let us know what you would like and we will take a look.');
    }

    /** @test */
    public function create_idea_form_does_show_when_logged_in()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertDontSee('Please login to add an idea.');
        $response->assertSee('Let us know what you would like and we will take a look.');
    }

    /** @test */
    public function main_page_contains_create_idea_livewire_component()
    {
        $this->actingAs(User::factory()->create())->get(route('idea.index'))
            ->assertSeeLivewire('create-idea');
    }

    /** @test */
    public function ccreate_idea_form_validation_works()
    {
        Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('createIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee('The title field is required.');
    }

    /** @test */
    public function create_idea_works_correctly()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Idea Title')
            ->set('category', $categoryOne->id)
            ->set('description', 'Idea Description')
            ->call('createIdea')
            ->assertRedirect(route('idea.index'));

        // Check that the idea shows up on the page
        $response = $this->actingAs($user)->get(route('idea.index'));
        $response->assertSuccessful();
        $response->assertSee('Idea Title');
        $response->assertSee('Idea Description');

        // Check that the idea shows up in the database
        $this->assertDatabaseHas('ideas', [
            'title' => 'Idea Title',
        ]);
    }

    /** @test */
    public function create_two_ideas_with_same_name_works_but_has_different_slugs()
    {
        $user = User::factory()->create();
        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'status--open']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Idea Title')
            ->set('category', $categoryOne->id)
            ->set('description', 'Idea Description')
            ->call('createIdea')
            ->assertRedirect(route('idea.index'));


        // Check that the idea shows up in the database
        $this->assertDatabaseHas('ideas', [
            'title' => 'Idea Title',
            'slug' => 'idea-title',
        ]);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Idea Title')
            ->set('category', $categoryOne->id)
            ->set('description', 'Idea Description Two')
            ->call('createIdea')
            ->assertRedirect(route('idea.index'));


        // Check that the idea shows up in the database
        $this->assertDatabaseHas('ideas', [
            'title' => 'Idea Title',
            'slug' => 'idea-title-2',
        ]);
    }
}
