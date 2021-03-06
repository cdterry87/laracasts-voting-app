<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkIdeaAsNotSpam extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsNotSpam()
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            return abort(Response::HTTP_FORBIDDEN);
        }
        
        $this->idea->spam_reports = 0;
        $this->idea->save();

        $this->emit('ideaMarkedAsNotSpam', 'Idea was marked as NOT spam!');
    }

    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }
}
