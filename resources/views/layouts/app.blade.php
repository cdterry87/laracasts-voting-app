<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Voting</title>

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
    >

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

    <!-- Scripts -->
    <script
        src="{{ asset('js/app.js') }}"
        defer
    ></script>
    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-900 text-sm bg-gray-100">
    <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
        <a href="/">Logo</a>
        <div class="flex items-center mt-2 md:mt-0">
            @if (Route::has('login'))
            <div class="px-6 py-4">
                @auth
                <div class="flex items-center gap-4">
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                        >
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    <div
                        x-data="{
                            isOpen: false
                        }"
                        class="relative"
                    >
                        <button @click="isOpen = !isOpen">
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
                            <div
                                class="flex justify-center items-center absolute top-0 right-0 -mr-1 -mt-1 rounded-full bg-red text-white border-2 border-white text-xxs w-5 h-5">
                                8
                            </div>
                        </button>
                        <ul
                            x-cloak
                            x-show="isOpen"
                            x-transition.origin.top.duration.200ms
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="absolute w-76 md:w-96 z-20 bg-white rounded-xl py-3 text-left shadow-dialog text-sm -right-24 md:-right-4 max-h-104 overflow-y-auto"
                        >

                            <li class="px-4 py-2"><a
                                    href="#"
                                    @click.prevent="
                                            isOpen = false
                                            $dispatch('edit-idea-modal')
                                        "
                                    class="flex hover:bg-gray-100 gap-4"
                                >
                                    <img
                                        src="https://gravatar.com/avatar/"
                                        alt="avatar"
                                        class="h-10 w-10 rounded-full"
                                    >
                                    <div>
                                        <div class="line-clamp-5">
                                            <span class="font-semibold">Chase</span>
                                            commented on
                                            <span class="font-semibold">This is my idea</span>:
                                            <span class="text-gray-500 text-xs mt-2">Lorem ipsum dolor sit amet
                                                consectetur adipisicing elit. Quibusdam,
                                                porro! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non,
                                                maxime doloremque minus repellendus quaerat itaque impedit iure atque
                                                voluptates praesentium.</span>
                                        </div>
                                        <div>1 hour ago</div>
                                    </div>
                                </a>
                            </li>

                            <li class="border-t border-gray-300 text-center">
                                <button class="w-full font-semibold px-5 py-4 hover:bg-gray-100">
                                    Mark all as read
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>


                @else
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Log in</a>

                @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                >Register</a>
                @endif
                @endauth
            </div>
            @endif
            <a href="#">
                <img
                    src="https://www.gravatar.com/avatar/0000000000000000000?d=mp"
                    alt="Avatar"
                    class="rounded-full w-8 h-8"
                >
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
        <div class="w-full md:w-70 mr-5 mx-auto px-4 md:px-0">
            <div class="bg-white border border-gray-200 rounded-xl mt-16 md:sticky md:top-8">
                <div class="text-center px-6 py-2 pt-6">
                    <h3 class="font-semibold text-base">Add an idea</h3>
                    <p class="text-xs mt-4">
                        @auth
                        Let us know what you would like and we will take a look.
                        @else
                        Please login to add an idea.
                        @endauth
                    </p>
                </div>

                @auth
                <livewire:create-idea />
                @else
                <div class="my-6 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="inline-block text-white w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="inline-block mt-4 w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-400 hover:bg-gray-300 transition duration-150 ease-in px-6 py-3"
                    >
                        Sign Up
                    </a>
                </div>
                @endauth

            </div>
        </div>
        <div class="w-full px-4 md:px-0 md:w-175">
            <livewire:status-filters />

            <div class="mt-8">
                {{ $slot }}
            </div>
        </div>
    </main>

    {{-- You can use @push('modals') directive to push modals to the bottom of this page --}}
    {{-- @stack('modals') --}}

    @if(session('success_message'))
    <x-notification-success
        :redirect="true"
        message-to-display="{{ session('success_message') }}"
    />
    @endif

    @livewireScripts
</body>

</html>
