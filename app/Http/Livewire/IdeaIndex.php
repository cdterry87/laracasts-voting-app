<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $votes;
    public $hasVoted = false;

    public function mount(Idea $idea, $votes)
    {
        $this->idea = $idea;
        $this->votes = $votes;
        $this->hasVoted = $idea->voted_by_user;
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}
