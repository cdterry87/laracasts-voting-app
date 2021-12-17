<x-app-layout>
  <div>
    {{-- @dump(url()->previous()) --}}
    <a
      href="{{ $backUrl }}"
      class="flex items-center font-semibold hover:underline"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M15 19l-7-7 7-7"
        />
      </svg>
      <span class="ml-2">All ideas (or back to chosen category with filters)</span>
    </a>
  </div>

  <livewire:idea-show
    :idea="$idea"
    :votes="$votes"
  />

  <x-notification-success />

  <x-modals-container :idea="$idea" />

  <div class="comments-container space-y-6 md:ml-22 my-8 relative pt-4">
    <div class="comment-container bg-white rounded-xl flex mt-4 relative">
      <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img
              src="https://source.unsplash.com/200x200/?face&crop=face&v=2"
              alt="avatar"
              class="w-14 h-14 rounded-xl"
            >
          </a>
        </div>
        <div class="mx-1 md:mx-4 w-full mt-2 md:mt-0">
          <div class="text-gray-600">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit qui optio ipsam doloremque accusamus
            impedit eum iusto quis voluptatum, nesciunt dignissimos eaque explicabo vero! Ipsa, voluptas molestias.
            Praesentium vero ipsum vel dolorem omnis voluptatum, officiis quis eaque earum optio cupiditate odio.
          </div>
          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
              <div class="font-bold text-gray-900">John Doe</div>
              <div>&bull;</div>
              <div>10 hours ago</div>
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
  </div>
</x-app-layout>