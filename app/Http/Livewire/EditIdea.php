<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Models\Category;

class EditIdea extends Component
{
    public $idea;

    public function render(Idea $idea)
    {
        return view('livewire.edit-idea', [
            'idea' => $this->idea,
            'categories' => Category::all()
        ]);
    }
}
