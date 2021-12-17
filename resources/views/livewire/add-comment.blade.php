<div
    x-data="{ isOpen: false }"
    x-init="
        Livewire.on('commentAdded', () => {
            isOpen = false
        })

        Livewire.hook('message.processed', (message, compoennt) => {
            if (message.updateQueue[0].payload.event === 'commentAdded' && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.classList.add('border-2')
                lastComment.classList.add('border-green')
                lastComment.scrollIntoView({ behavior: 'smooth' })

                setTimeout(() => {
                    lastComment.classList.remove('border-2')
                    lastComment.classList.remove('border-green')
                }, 5000)
            }
        })
    "
    class="relative w-full md:w-auto"
>
    <button
        class="text-white h-11 w-full md:w-32 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
        type="button"
        @click="
        isOpen = !isOpen
        if (isOpen) {
            $nextTick(() => $refs.comment.focus())
        }
        "
    >
        Reply
    </button>
    <div
        x-cloak
        x-show="isOpen"
        x-transition.origin.top.left.duration.200ms
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
        class="absolute z-10 w-full md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2"
    >

        @auth
        <form
            wire:submit.prevent="addComment"
            class="space-y-4 px-4 py-6"
        >
            <div>
                <textarea
                    x-ref="comment"
                    wire:model="comment"
                    name="comment"
                    id="comment"
                    cols="30"
                    rows="4"
                    class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                    placeholder="Go ahead, don't be shy. Share your thoughts."
                    required
                ></textarea>
                @error('comment')
                <p class="text-red text-xs mt-1">{{ $message }} </p>
                @enderror
            </div>

            <div class="flex items-center space-x-3">
                <button
                    type="submit"
                    class="text-white h-11 w-2/3 md:w-1/2 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                >
                    Post Comment
                </button>
                <button
                    type="button"
                    class="flex items-center justify-center w-1/3 md:w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    <svg
                        class="hidden md:block text-gray-600 w-4 transform -rotate-45"
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
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                        />
                    </svg>
                    <span class="ml-1">Attach</span>
                </button>
            </div>
        </form>
        @else
        <div class="px-4 py-6">
            <p class="font-normal">
                Please login or create an account to post a comment.
            </p>
            <div class="flex items-center space-x-3 mt-8">
                <a
                    href="{{ route('login') }}"
                    class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                >Login</a>
                <a
                    href="{{ route('register') }}"
                    class="w-1/2 h-11 text-sm text-center bg-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-400 transition duration-150 ease-in px-6 py-3"
                >Sign Up</a>
            </div>
        </div>
        @endauth
    </div>
</div>