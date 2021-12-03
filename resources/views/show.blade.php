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
              Open
            </div>
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
      <div class="relative">
        <button type="button"
          class="text-white h-11 w-32 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
          Reply
        </button>
        <div class="absolute z-10 w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
          <form action="" class="space-y-4 px-4 py-6">
            <div class="flex items-center">
              <textarea name="comment" id="comment" cols="30" rows="4"
                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                placeholder="Go ahead, don't be shy. Share your thoughts."></textarea>
            </div>
            <div class="flex items-center space-x-3">
              <button type="submit"
                class="text-white h-11 w-1/2 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                Post Comment
              </button>
              <button type="button"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <svg class="text-gray-600 w-4 transform -rotate-45" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <span class="ml-1">Attach</span>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="relative">
        <button type="button"
          class="flex items-center justify-center h-11 w-36 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
          <span>Set Status</span>
          <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="absolute z-20 w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
          <form action="" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
              <div>
                <label class="inline-flex items-center">
                  <input type="radio" name="status" value="1" class="bg-gray-200 border-none text-blue">
                  <span class="ml-2">Open</span>
                </label>
              </div>
              <div>
                <label class="inline-flex items-center">
                  <input type="radio" name="status" value="1" class="bg-gray-200 border-none text-purple">
                  <span class="ml-2">Considering</span>
                </label>
              </div>
              <div>
                <label class="inline-flex items-center">
                  <input type="radio" name="status" value="1" class="bg-gray-200 border-none text-yellow">
                  <span class="ml-2">In Progress</span>
                </label>
              </div>
              <div>
                <label class="inline-flex items-center">
                  <input type="radio" name="status" value="4" class="bg-gray-200 border-none text-green">
                  <span class="ml-2">Implemented</span>
                </label>
              </div>
              <div>
                <label class="inline-flex items-center">
                  <input type="radio" name="status" value="5" class="bg-gray-200 border-none text-red">
                  <span class="ml-2">Closed</span>
                </label>
              </div>
            </div>
            <div>
              <textarea name="update_comment" id="update_comment" cols="30" rows="3"
                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                placeholder="Add an update comment (optional)"></textarea>
            </div>
            <div class="flex items-center justify-between space-x-3">
              <button type="button"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <svg class="text-gray-600 w-4 transform -rotate-45" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <span class="ml-1">Attach</span>
              </button>
              <button type="submit"
                class="text-white w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                Update
              </button>
            </div>
            <div>
              <label class="inline-flex items-center font-normal">
                <input type="checkbox" name="notify_voters" class="rounded bg-gray-200">
                <span class="ml-2">Notify all voters</span>
              </label>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="flex items-center space-x-3">
      <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 border">
        <div class="text-xl leading-snug">12</div>
        <div class="text-gray-400 text-xs leading-none uppercase">Votes</div>
      </div>
      <button type="button"
        class="h-11 w-32 text-sm uppercase bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        Vote
      </button>
    </div>
  </div>

  <div class="comments-container space-y-6 ml-22 my-8 relative pt-4">
    <div class="comment-container bg-white rounded-xl flex mt-4 relative">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar"
              class="w-14 h-14 rounded-xl">
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
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete
                      post</a>
                  </li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-container is-admin bg-white rounded-xl flex mt-4 relative border border-blue">
      <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
          <a href="#">
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar"
              class="w-14 h-14 rounded-xl">
          </a>
          <div class="uppercase text-center text-blue font-bold text-xxs mt-2">Admin</div>
        </div>
        <div class="mx-4 w-full">
          <h4 class="text-xl font-semibold">
            Status changed to "Under Consideration"
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
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete
                      post</a>
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
            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar"
              class="w-14 h-14 rounded-xl">
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
                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete
                      post</a>
                  </li>
                </ul>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>