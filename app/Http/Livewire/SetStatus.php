<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Illuminate\Http\Response;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $update_comment;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()){
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->status_id = $this->status;
        // $this->idea->update_comment = $this->update_comment;
        $this->idea->save();

        $this->emit('statusUpdated');
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
