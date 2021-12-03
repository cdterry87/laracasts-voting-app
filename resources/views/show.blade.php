<x-app-layout>
  <div>
    <a href="/" class="flex items-center font-semibold hover:underline">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      <span class="ml-2">All ideas</span>
    </a>
  </div>

  <div class="idea-container bg-white rounded-xl flex mt-4">
    <div class="flex flex-1 px-4 py-6">
      <div class="flex-none">
        <a href="#">
          <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
        </a>
      </div>
      <div class="mx-4 w-full">
        <h4 class="text-xl font-semibold">
          <a href="#" class="hover:underline">A random title can go here</a>
        </h4>
        <div class="text-gray-600 mt-3 line-clamp-3">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit qui optio ipsam doloremque accusamus
          impedit eum iusto quis voluptatum, nesciunt dignissimos eaque explicabo vero! Ipsa, voluptas molestias.
          Praesentium vero ipsum vel dolorem omnis voluptatum, officiis quis eaque earum optio cupiditate odio. Natus
          error magni labore beatae recusandae placeat quae dignissimos optio corrupti eligendi laborum autem obcaecati
          libero, id velit et eveniet, quo sed ad voluptas. Soluta deleniti dolorem, quos dignissimos, at ad sunt earum
          explicabo exercitationem laudantium nam saepe ipsa, asperiores similique! Harum at quidem facilis iste
          laudantium neque amet, voluptatem, ad dignissimos cupiditate quaerat natus perferendis inventore sapiente ut.
        </div>
        <div class="flex items-center justify-between mt-6">
          <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
            <div class="font-bold text-gray-900">John Doe</div>
            <div>&bull;</div>
            <div>10 hours ago</div>
            <div>&bull;</div>
            <div>Category 1</div>
            <div>&bull;</div>
            <div class="text-gray-900">3 Comments</div>
          </div>
          <div class="flex items-center space-x-2">
            <div
              class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
              Open</div>
            <button
              class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
              <svg fill="currentColor" class="text-gray-400" width="24" height="6">
                <path
                  d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                </path>
              </svg>
              <ul class="absolute w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog">
                <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as
                    spam</a></li>
                <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete post</a>
                </li>
              </ul>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="buttons-container flex items-center justify-between mt-6 ml-12">
    <div class="flex items-center space-x-4">
      <button type="button"
        class="text-white h-11 w-32 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
        Reply
      </button>
      <button type="button"
        class="flex items-center justify-center h-11 w-36 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        <span>Set Status</span>
        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
    </div>
    <div class="flex items-center space-x-3">
      <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 border">
        <div class="text-xl leading-snug">12</div>
        <div class="text-gray-400 text-xs leading-none uppercase">Votes</div>
      </div>
      <button type="button"
        class="h-11 w-32 text-xs uppercase bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        Vote
      </button>
    </div>
  </div>

  <div class="comments-container space-y-6 ml-22 my-8 relative pt-4">
    <div class="comment-container bg-white rounded-xl flex mt-4 relative">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
        </div>
        <div class="mx-4 w-full">
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
            <div class="flex items-center space-x-2">
              <button
                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
                <svg fill="currentColor" class="text-gray-400" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                  </path>
                </svg>
                <ul class="absolute w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog">
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as
                      spam</a></li>
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete post</a>
                  </li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-container is-admin bg-white rounded-xl flex mt-4 relative">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
          <div class="uppercase text-center text-blue font-bold text-xxs mt-2">Admin</div>
        </div>
        <div class="mx-4 w-full">
          <h4 class="text-xl font-semibold">
            Status changed to "Under Construction"
          </h4>
          <div class="text-gray-600 mt-3">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
          </div>
          <div class="flex items-center justify-between mt-6">
            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
              <div class="font-bold text-blue">John Doe</div>
              <div>&bull;</div>
              <div>10 hours ago</div>
            </div>
            <div class="flex items-center space-x-2">
              <button
                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
                <svg fill="currentColor" class="text-gray-400" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                  </path>
                </svg>
                <ul class="absolute w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog">
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as
                      spam</a></li>
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete post</a>
                  </li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-container bg-white rounded-xl flex mt-4 relative">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl">
          </a>
        </div>
        <div class="mx-4 w-full">
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
            <div class="flex items-center space-x-2">
              <button
                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3 border">
                <svg fill="currentColor" class="text-gray-400" width="24" height="6">
                  <path
                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                  </path>
                </svg>
                <ul class="absolute w-44 font-semibold bg-white rounded-xl py-3 ml-8 text-left shadow-dialog">
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as
                      spam</a></li>
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete post</a>
                  </li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>