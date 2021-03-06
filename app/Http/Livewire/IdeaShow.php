<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;

class IdeaShow extends Component
{
    public $idea;
    public $votes;
    public $hasVoted = false;

    protected $listeners = [
        'statusUpdated',
        'ideaUpdated',
        'ideaMarkedAsSpam',
        'ideaMarkedAsNotSpam',
        'commentAdded',
        'commentDeleted'
    ];

    public function statusUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaMarkedAsSpam()
    {
        $this->idea->refresh();
    }

    public function ideaMarkedAsNotSpam()
    {
        $this->idea->refresh();
    }

    public function commentAdded()
    {
        $this->idea->refresh();
    }

    public function commentDeleted()
    {
        $this->idea->refresh();
    }

    public function mount(Idea $idea, $votes)
    {
        $this->idea = $idea;
        $this->votes = $votes;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function vote()
    {
        if (auth()->guest()){
            redirect()->setIntendedUrl(url()->previous());

            return redirect()->route('login');
        }

        if ($this->hasVoted) {
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFoundException $e) {
                //
            }
            $this->votes -= 1;
            $this->hasVoted = false;
        } else {
            try {
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {
            }
            $this->votes += 1;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
