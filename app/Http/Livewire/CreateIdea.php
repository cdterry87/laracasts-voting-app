<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Response;

class CreateIdea extends Component
{
    public $title;
    public $category = 1;
    public $description;

    protected $rules = [
        'title' => 'required|min:5',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:10',
    ];

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all(),
        ]);
    }

    public function createIdea()
    {
        // Abort if user is not logged in
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $idea = Idea::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Automatically vote for the idea when it is created
        $idea->vote(auth()->user());

        session()->flash('success_message', 'Idea created successfully!');
        $this->reset();
        return redirect()->route('idea.index');

    }
}
