<div x-data
     @click="const target = $event.target.tagName.toLowerCase()
                    const ignores = ['button','svg','path','a', 'img']
                    const ideaLink = $event.target.closest('.idea-container').querySelector('.idea-link')

                    !ignores.includes(target) && ideaLink.click()"
     class="idea-container bg-white rounded-xl flex cursor-pointer">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl">{{ $votes }}</div>
            <div class="text-gray-500">Votes</div>
        </div>

        <div class="mt-8">
            <button
                    class="w-20 bg-gray-200 font-bold text-xs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in">Vote</button>
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-4">
            <a href="#">
                <img src="{{ $idea->user->getAvatar() }}"
                     alt="avatar"
                     class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="mx-4 w-full flex flex-col justify-between">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('idea.show', $idea) }}"
                   class="idea-link hover:underline">{{ $idea->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                {{ $idea->description }}
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $idea->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-0"
                     x-data="{ isOpen: false }">
                    <div
                         class="{{ $idea->status->classes }} bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                        {{ $idea->status->name }}</div>
                    <button @click="isOpen = !isOpen"
                            class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
                        <svg fill="currentColor"
                             class="text-gray-400"
                             width="24"
                             height="6">
                            <path
                                  d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                            </path>
                        </svg>
                        <ul x-cloak
                            x-show="isOpen"
                            x-transition.origin.top.left.duration.200ms
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="absolute w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog md:ml-8 top-8 md:top-6 right-0 md:left-0">
                            <li><a href=""
                                   class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark
                                    as spam</a></li>
                            <li><a href=""
                                   class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete
                                    post</a></li>
                        </ul>
                    </button>
                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-4">
                    <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none">{{ $votes }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400 uppercase">Votes</div>
                    </div>
                    <button type="button"
                            class="-mx-6 text-sm uppercase bg-gray-200 font-semibold rounded-full border border-gray-200 hover:border-gray-400 transition duration-150 ease-in h-10 px-4 py-2">
                        Vote
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>