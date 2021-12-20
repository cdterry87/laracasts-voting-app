<div
    x-data="{
        isOpen: false
    }"
    wire:poll="getNotificationCount"
    class="relative"
>
    <button @click="
        isOpen = !isOpen
        if (isOpen) {
            Livewire.emit('getNotifications')
        }
    ">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 text-gray-400"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
            />
        </svg>
        @if($notificationCount > 0)
        <div
            class="flex justify-center items-center absolute top-0 right-0 -mr-1 -mt-1 rounded-full bg-red text-white border-2 border-white text-xxs w-5 h-5">
            {{ $notificationCount }}
        </div>
        @endif
    </button>
    <ul
        x-cloak
        x-show="isOpen"
        x-transition.origin.top.duration.200ms
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
        class="absolute w-76 md:w-96 z-20 bg-white rounded-xl py-3 text-left shadow-dialog text-sm -right-24 md:-right-4 max-h-104 overflow-y-auto"
    >
        @if($notifications->isNotEmpty() && !$isLoading)
        @foreach($notifications as $notification)
        <li class="px-4 py-2"><a
                @click.prevent="isOpen = false"
                wire:click.prevent="markAsRead('{{ $notification->id }}')"
                class="flex hover:bg-gray-100 gap-4"
            >
                <img
                    src="{{ $notification->data['user_avatar'] }}"
                    alt="avatar"
                    class="h-10 w-10 rounded-full"
                >
                <div>
                    <div class="line-clamp-5">
                        <span class="font-semibold">{{ $notification->data['user_name'] }}</span>
                        commented on
                        <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>:
                        <span class="text-gray-500 text-xs mt-2">{{ $notification->data['comment_body'] }}</span>
                    </div>
                    <div>{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </a>
        </li>
        @endforeach

        <li class="border-t border-gray-300 text-center">
            <button
                wire:click="markAllAsRead"
                @click="isOpen = false"
                class="w-full font-semibold px-5 py-4 hover:bg-gray-100"
            >
                Mark all as read
            </button>
        </li>
        @elseif($isLoading)
        @foreach(range(1, 3) as $i)
        <li class="flex items-center transition duration-150 ease-in px-5 py-4 animate-pulse">
            <div class="bg-gray-200 rounded-full w-10 h-10"></div>
            <div class="flex-1 flex flex-col gap-1 ml-4">
                <div class="bg-gray-200 w-full rounded h-4"></div>
                <div class="bg-gray-200 w-full rounded h-4"></div>
                <div class="bg-gray-200 w-1/2 rounded h-4"></div>
            </div>
        </li>
        @endforeach
        @else
        <div class="mx-auto w-40 py-6">
            <img
                src="https://raw.githubusercontent.com/laracasts/lc-voting/8fa083a3b8034e90b3c05b2d8e569e30721ac7d8/public/img/no-ideas.svg"
                alt="No Results"
                class="mx-auto mix-blend-luminosity"
            >
            <div class="text-gray-400 text-center font-bold mt-6">
                No new notifications
            </div>
        </div>

        @endif
    </ul>
</div>
