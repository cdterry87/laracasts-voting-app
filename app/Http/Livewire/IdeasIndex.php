<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $status;
    public $category;

    protected $queryString = [
        'status',
        'category'
    ];

    protected $listeners = ['queryStringUpdatedStatus'];

    public function mount()
    {
        $this->status = request()->status ?? 'All';
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->resetPage();
    }

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');
        $categories = Category::all()->pluck('id', 'name');

        return view('livewire.ideas-index', [
            'ideas' => Idea::with('user', 'category', 'status')
                ->when($this->status && $this->status !== 'All', function ($query) use ($statuses) {
                    return $query->where('status_id', $statuses->get($this->status));
                })
                ->when($this->category && $this->category !== 'All Categories', function ($query) use ($categories){
                    return $query->where('category_id', $categories->get($this->category));
                })
                ->addSelect(['voted_by_user' => 
                    Vote::select('id')
                        ->where('user_id', auth()->id())
                        ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')
                ->orderBy('id', 'desc')
                ->paginate(Idea::PAGINATION_COUNT),
            'categories' => Category::all()
        ]);
    }
}
