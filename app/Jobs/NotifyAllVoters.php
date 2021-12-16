<?php

namespace App\Jobs;

use App\Models\Idea;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\IdeaStatusUpdatedMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifyAllVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $idea;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->idea->votes()
        ->select('name', 'email')
        ->chunk(100, function ($voters) {
            foreach ($voters as $user) {
                // if ($user->accepts_notifications) {} // This would be an optional thing to add later to the user model so users don't have to accept nofications
                Mail::to($user)
                    ->queue(new IdeaStatusUpdatedMailable($this->idea));
            }
        }); // chunk by 100 to avoid memory issues
    }
}
