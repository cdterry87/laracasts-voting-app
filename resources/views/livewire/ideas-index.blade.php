<div class="ideas--index">
    <div class="filters flex flex-col space-y-3 md:flex-row md:space-x-6 md:space-y-0">
        <div class="w-full md:w-1/4">
            <select
                name="category"
                wire:model="category"
                id="category"
                class="w-full rounded-xl px-4 py-2 border-none"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/4">
            <select
                name="filter"
                wire:model="filter"
                id="filter"
                class="w-full rounded-xl px-4 py-2 border-none"
            >
                <option value="No Filter">No Filters</option>
                <option value="Top Voted">Top Voted</option>
                <option value="My Ideas">My Ideas</option>
                @admin
                <option value="Spam Ideas">Spam Ideas</option>
                <option value="Spam Comments">Spam Comments</option>
                @endadmin
            </select>
        </div>
        <div class="w-full md:w-1/2 relative">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg
                    class="w-4 text-gray-700"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
            </div>
            <input
                type="search"
                wire:model.debounce.1000ms="search"
                placeholder="Find an idea"
                class="w-full rounded-xl bg-white px-4 py-2 pl-8 border-none placeholder-gray-900"
            >
        </div>
    </div>

    @forelse($ideas as $idea)
    <div class="ideas-container space-y-6 my-6 hover:shadow-card transition duration-150 ease-in">
        <livewire:idea-index
            :idea="$idea"
            :votes="$idea->votes_count"
            :key="$idea->id"
        />
    </div>
    @empty
    <div class="mx-auto w-70 mt-12">
        <img
            src="https://raw.githubusercontent.com/laracasts/lc-voting/8fa083a3b8034e90b3c05b2d8e569e30721ac7d8/public/img/no-ideas.svg"
            alt="No Results"
            class="mx-auto mix-blend-luminosity"
        >
        <div class="text-gray-400 text-center font-bold mt-6">
            Sorry, No ideas were found.
        </div>
    </div>
    @endforelse

    <div class="my-8">
        {{ $ideas->links() }}
    </div>
</div>
