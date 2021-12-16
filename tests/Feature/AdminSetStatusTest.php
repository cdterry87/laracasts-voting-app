<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Jobs\NotifyAllVoters;
use App\Http\Livewire\SetStatus;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_set_status_livewire_component_if_admin()
    {
        $user = User::factory()->create([
            'email' => 'chase.terry87@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('set-status');
    }

    /** @test */
    public function show_page_not_contains_set_status_livewire_component_if_not_admin()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('set-status');
    }

    /** @test */
    public function initial_status_is_set_correctly()
    {
        $user = User::factory()->create([
            'email' => 'chase.terry87@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $status = Status::factory()->create(['name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->assertSet('status', $status->id);
    }

    /** @test */
    public function can_set_status_correctly()
    {
        $user = User::factory()->create([
            'email' => 'chase.terry87@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $status = Status::factory()->create(['name' => 'Open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->set('status', $statusConsidering->id)
            ->call('setStatus')
            ->assertEmitted('statusUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusConsidering->id
        ]);
    }

    /** @test */
    public function can_set_status_correctly_while_notifying_all_voters()
    {
        $user = User::factory()->create([
            'email' => 'chase.terry87@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $categoryTwo = Category::factory()->create(['name' => 'Category Two']);
        $status = Status::factory()->create(['name' => 'Open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        Queue::fake();
        Queue::assertNothingPushed();

        Livewire::actingAs($user)
            ->test(SetStatus::class, ['idea' => $idea])
            ->set('status', $statusConsidering->id)
            ->set('notifyAllVoters', true)
            ->call('setStatus')
            ->assertEmitted('statusUpdated');

        Queue::assertPushed(NotifyAllVoters::class);

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusConsidering->id
        ]);
    }
}
