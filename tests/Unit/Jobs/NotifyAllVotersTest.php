<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use App\Jobs\NotifyAllVoters;
use Illuminate\Support\Facades\Mail;
use App\Mail\IdeaStatusUpdatedMailable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifyAllVotersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function notifies_all_voters()
    {
        $user = User::factory()->create([
            'email' => 'chase.terry87@gmail.com'
        ]);

        $userB = User::factory()->create([
            'email' => 'chase@user.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'Category One']);
        $status = Status::factory()->create(['name' => 'Open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => 'My First Idea',
            'description' => 'This is my first idea.',
        ]);

        Vote::create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Vote::create([
            'user_id' => $userB->id,
            'idea_id' => $idea->id,
        ]);

        Mail::fake();

        NotifyAllVoters::dispatch($idea);
        
        Mail::assertQueued(IdeaStatusUpdatedMailable::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email)
                && $mail->build()->subject === 'An idea you voted for has a new status';
        });

        Mail::assertQueued(IdeaStatusUpdatedMailable::class, function ($mail) use ($userB) {
            return $mail->hasTo($userB->email)
                && $mail->build()->subject === 'An idea you voted for has a new status';
        });
    }
}
