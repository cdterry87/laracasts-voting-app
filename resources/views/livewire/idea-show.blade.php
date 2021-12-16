<div class="idea-and-buttons-container">
    <div class="idea-container bg-white rounded-xl flex mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2">
                <a href="#">
                    <img src="{{ $idea->user->getAvatar() }}"
                         alt="avatar"
                         class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="mx-4 w-full">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    {{ $idea->title }}
                </h4>
                <div class="text-gray-600 line-clamp-3">
                    {{ $idea->description}}
                </div>
                <div class="font-bold text-gray-900 mt-6">{{ $idea->user->name }}</div>
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div>&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $idea->category->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div class="hidden md:block text-gray-900">3 Comments</div>
                    </div>
                    <div class="flex items-center space-x-2 mt-4 md:mt-0"
                         x-data="{ isOpen: false }">
                        <div
                             class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                            {{ $idea->status->name }}</div>
                        <div class="relative">
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
                            </button>


                            <ul x-cloak
                                x-show="isOpen"
                                x-transition.origin.top.left.duration.200ms
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="absolute w-44 font-semibold z-20 bg-white rounded-xl py-3 ml-8 text-left shadow-dialog md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                <li><a href=""
                                       class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Edit
                                        post</a>
                                </li>
                                <li><a href=""
                                       class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as
                                        spam</a></li>
                                <li><a href=""
                                       class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete
                                        post</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center md:hidden mt-4 md:mt-4">
                        <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votes }}
                            </div>
                            <div class="text-xxs font-semibold leading-none text-gray-400 uppercase">Votes</div>
                        </div>
                        @if($hasVoted)
                        <button type="button"
                                wire:click.prevent="vote"
                                class="-mx-6 text-sm uppercase bg-blue text-white border-blue hover:border-blue font-semibold rounded-full border transition duration-150 ease-in h-10 px-4 py-2">
                            Voted
                        </button>
                        @else
                        <button type="button"
                                wire:click.prevent="vote"
                                class="-mx-6 text-sm uppercase bg-gray-200 font-semibold rounded-full border border-gray-200 hover:border-gray-400 transition duration-150 ease-in h-10 px-4 py-2">
                            Vote
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons-container flex items-center justify-between mt-6 md:ml-12">
        <div x-data="{ isOpen: false }"
             class="flex flex-col space-y-4 md:space-y-0 md:flex-row w-full md:w-auto items-center md:space-x-4">
            <div class="relative w-full md:w-auto">
                <button type="button"
                        @click="isOpen = !isOpen"
                        class="text-white h-11 w-full md:w-32 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                    Reply
                </button>
                <div x-cloak
                     x-show="isOpen"
                     x-transition.origin.top.left.duration.200ms
                     @click.away="isOpen = false"
                     @keydown.escape.window="isOpen = false"
                     class="absolute z-10 w-full md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                    <form action=""
                          class="space-y-4 px-4 py-6">
                        <div class="flex items-center">
                            <textarea name="comment"
                                      id="comment"
                                      cols="30"
                                      rows="4"
                                      class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                                      placeholder="Go ahead, don't be shy. Share your thoughts."></textarea>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="submit"
                                    class="text-white h-11 w-2/3 md:w-1/2 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                Post Comment
                            </button>
                            <button type="button"
                                    class="flex items-center justify-center w-1/3 md:w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg class="hidden md:block text-gray-600 w-4 transform -rotate-45"
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @auth
            @if (auth()->user()->isAdmin())
            <livewire:set-status :idea="$idea" />
            @endif
            @endauth

        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 border">
                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{ $votes }}</div>
                <div class="text-gray-400 text-xs leading-none uppercase">Votes</div>
            </div>
            @if($hasVoted)
            <button type="button"
                    wire:click.prevent="vote"
                    class="bg-blue text-white border-blue hover:border-blue h-11 w-32 text-sm uppercase font-semibold rounded-xl border transition duration-150 ease-in px-6 py-3">
                Voted
            </button>
            @else
            <button type="button"
                    wire:click.prevent="vote"
                    class="h-11 w-32 text-sm uppercase bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                Vote
            </button>
            @endif
        </div>
    </div>
</div>