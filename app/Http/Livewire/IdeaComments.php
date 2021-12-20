<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;

    public $idea;

    protected $listeners = [
        'commentAdded',
        'commentDeleted'
    ];

    public function commentAdded()
    {
        $this->idea->refresh();

        // GO to the last page when adding a new comment
        $this->goToPage($this->idea->comments()->paginate()->lastPage());
    }

    public function commentDeleted()
    {
        $this->idea->refresh();
        $this->goToPage(1);
    }

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            // 'comments' => $this->idea->comments()->paginate()->withQueryString(),
            'comments' => Comment::with('user')->where('idea_id', $this->idea->id)->paginate()->withQueryString()
        ]);
    }
}
