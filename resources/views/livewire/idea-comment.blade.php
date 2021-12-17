<div class="comment-container bg-white rounded-xl flex mt-4 relative transition duration-150 ease-in">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img
                    src="{{ $comment->user->getAvatar() }}"
                    alt="avatar"
                    class="w-14 h-14 rounded-xl"
                >
            </a>
        </div>
        <div class="mx-1 md:mx-4 w-full md:mt-0">
            <div class="text-gray-600">
                {{ $comment->body}}
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                    <div class="font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    @if ($comment->user->id === $ideaUserId)
                    <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                    <div>&bull;</div>
                    @endif
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <div
                    class="flex items-center mt-2 md:mt-0 md:space-x-2"
                    x-data="{isOpen: false}"
                >
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
                            class="absolute z-20 w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog md:ml-8 top-8 md:top-6 right-0 md:left-0"
                        >
                            <li><a
                                    href=""
                                    class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                >
                                    Mark as spam
                                </a></li>
                            <li><a
                                    href=""
                                    class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block"
                                >
                                    Delete Idea
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>