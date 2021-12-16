<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class EditIdea extends Component
{
    public $idea;
    public $title;
    public $category ;
    public $description;

    protected $rules = [
        'title' => 'required|min:5',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:10',
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;
    }

    public function updateIdea()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->idea)) {
            return abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description,
        ]);

        $this->emit('ideaUpdated');
    }

    public function render(Idea $idea)
    {
        return view('livewire.edit-idea', [
            'idea' => $this->idea,
            'categories' => Category::all()
        ]);
    }
}
