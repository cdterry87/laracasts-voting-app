<div
    x-data
    @click="const target = $event.target.tagName.toLowerCase()
                    const ignores = ['button','svg','path','a', 'img']
                    const ideaLink = $event.target.closest('.idea-container').querySelector('.idea-link')

                    !ignores.includes(target) && ideaLink.click()"
    class="idea-container bg-white rounded-xl flex cursor-pointer"
>
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($hasVoted) text-blue @endif">{{ $votes }}</div>
            <div class="text-gray-500">Votes</div>
        </div>

        <div class="mt-8">
            @if($hasVoted)
            <button
                wire:click.prevent="vote"
                class="w-20 bg-blue text-white font-bold text-xs uppercase rounded-xl px-4 py-3 border border-blue hover:border-blue transition duration-150 ease-in"
            >Voted</button>
            @else
            <button
                wire:click.prevent="vote"
                class="w-20 bg-gray-200 font-bold text-xs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in"
            >Vote</button>
            @endif
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-4">
            <a href="#">
                <img
                    src="{{ $idea->user->getAvatar() }}"
                    alt="avatar"
                    class="w-14 h-14 rounded-xl"
                >
            </a>
        </div>
        <div class="mx-4 w-full flex flex-col justify-between">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a
                    href="{{ route('idea.show', $idea) }}"
                    class="idea-link hover:underline"
                >{{ $idea->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                @admin
                @if ($idea->spam_reports > 0)
                <div class="text-red mb-2">
                    Spam reports: {{ $idea->spam_reports }}
                </div>
                @endif
                @endadmin
                {{ $idea->description }}
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $idea->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">{{ $idea->comments_count }} comments</div>
                </div>
                <div
                    class="flex items-center space-x-2 mt-4 md:mt-0"
                    x-data="{ isOpen: false }"
                >
                    <div
                        class="{{ $idea->status->classes }} bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                        {{ $idea->status->name }}</div>

                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-4">
                    <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votes }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400 uppercase">Votes</div>
                    </div>
                    @if($hasVoted)
                    <button
                        type="button"
                        wire:click.prevent="vote"
                        class="-mx-6 text-sm uppercase bg-blue text-white font-semibold rounded-full border border-blue hover:border-blue transition duration-150 ease-in h-10 px-4 py-2"
                    >
                        Voted
                    </button>
                    @else
                    <button
                        type="button"
                        wire:click.prevent="vote"
                        class="-mx-6 text-sm uppercase bg-gray-200 font-semibold rounded-full border border-gray-200 hover:border-gray-400 transition duration-150 ease-in h-10 px-4 py-2"
                    >
                        Vote
                    </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>