<div class="idea-and-buttons-container">
    <div class="idea-container bg-white rounded-xl flex mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2">
                <a href="#">
                    <img
                        src="{{ $idea->user->getAvatar() }}"
                        alt="avatar"
                        class="w-14 h-14 rounded-xl"
                    >
                </a>
            </div>
            <div class="mx-4 w-full">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    {{ $idea->title }}
                </h4>
                <div class="text-gray-600 line-clamp-3">
                    @admin
                    @if ($idea->spam_reports > 0)
                    <div class="text-red my-2">
                        Spam reports: {{ $idea->spam_reports }}
                    </div>
                    @endif
                    @endadmin
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
                        <div class="hidden md:block text-gray-900">{{ $idea->comments->count() }} comments</div>
                    </div>
                    <div
                        class="flex items-center space-x-2 mt-4 md:mt-0"
                        x-data="{ isOpen: false }"
                    >
                        <div
                            class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                            {{ $idea->status->name }}</div>

                        @auth
                        <div class="relative">
                            <button
                                @click="isOpen = !isOpen"
                                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border"
                            >
                                <svg
                                    fill="currentColor"
                                    class="text-gray-400"
                                    width="24"
                                    height="6"
                                >
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                    >
                                    </path>
                                </svg>
                            </button>

                            <ul
                                x-cloak
                                x-show="isOpen"
                                x-transition.origin.top.left.duration.200ms
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="absolute w-44 font-semibold z-20 bg-white rounded-xl py-3 ml-8 text-left shadow-dialog md:ml-8 top-8 md:top-6 right-0 md:left-0"
                            >

                                @can('update', $idea)
                                <li><a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('edit-idea-modal')
                                        "
                                        class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                    >
                                        Edit Idea
                                    </a>
                                </li>
                                @endcan

                                @can('delete', $idea)
                                <li>
                                    <a
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('delete-idea-modal')
                                        "
                                        href=""
                                        class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                    >
                                        Delete Idea
                                    </a>
                                </li>
                                @endcan

                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('mark-idea-as-spam-modal')
                                        "
                                        class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                    >
                                        Mark as Spam
                                    </a>
                                </li>

                                @if ($idea->spam_reports > 0)
                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('mark-idea-as-not-spam-modal')
                                        "
                                        class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                    >
                                        Not Spam
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                        @endauth
                    </div>
                    <div class="flex items-center md:hidden mt-4 md:mt-4">
                        <div class="bg-gray-100 text-center rounded-full h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votes }}
                            </div>
                            <div class="text-xxs font-semibold leading-none text-gray-400 uppercase">Votes</div>
                        </div>
                        @if($hasVoted)
                        <button
                            type="button"
                            wire:click.prevent="vote"
                            class="-mx-6 text-sm uppercase bg-blue text-white border-blue hover:border-blue font-semibold rounded-full border transition duration-150 ease-in h-10 px-4 py-2"
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

    <div class="buttons-container flex items-center justify-between mt-6 md:ml-12">
        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row w-full md:w-auto items-center md:space-x-4">
            <livewire:add-comment :idea="$idea" />

            @admin
            <livewire:set-status :idea="$idea" />
            @endadmin

        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 border">
                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{ $votes }}</div>
                <div class="text-gray-400 text-xs leading-none uppercase">Votes</div>
            </div>
            @if($hasVoted)
            <button
                type="button"
                wire:click.prevent="vote"
                class="bg-blue text-white border-blue hover:border-blue h-11 w-32 text-sm uppercase font-semibold rounded-xl border transition duration-150 ease-in px-6 py-3"
            >
                Voted
            </button>
            @else
            <button
                type="button"
                wire:click.prevent="vote"
                class="h-11 w-32 text-sm uppercase bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
            >
                Vote
            </button>
            @endif
        </div>
    </div>
</div>