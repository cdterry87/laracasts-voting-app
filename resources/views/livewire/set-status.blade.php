<div class="relative w-full md:w-auto"
     x-data="{ isOpen: false }"
     x-init="window.livewire.on('statusUpdated', () => {
       isOpen = false
     })">
  <button @click="isOpen = !isOpen"
          type="button"
          class="flex items-center justify-center h-11 w-full md:w-36 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
    <span>Set Status</span>
    <svg class="w-4 h-4 ml-2"
         xmlns="http://www.w3.org/2000/svg"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
      <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7" />
    </svg>
  </button>
  <div x-cloak
       x-show="isOpen"
       x-transition.origin.top.left.duration.200ms
       @click.away="isOpen = false"
       @keydown.escape.window="isOpen = false"
       class="absolute z-20 w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
    <form action=""
          wire:submit.prevent="setStatus"
          class="space-y-4 px-4 py-6">

      <div class="space-y-2">
        <div>
          <label class="inline-flex items-center">
            <input type="radio"
                   wire:model="status"
                   name="status"
                   value="1"
                   class="bg-gray-200 border-none text-blue">
            <span class="ml-2">Open</span>
          </label>
        </div>
        <div>
          <label class="inline-flex items-center">
            <input type="radio"
                   wire:model="status"
                   name="status"
                   value="2"
                   class="bg-gray-200 border-none text-purple">
            <span class="ml-2">Considering</span>
          </label>
        </div>
        <div>
          <label class="inline-flex items-center">
            <input type="radio"
                   wire:model="status"
                   name="status"
                   value="3"
                   class="bg-gray-200 border-none text-yellow">
            <span class="ml-2">In Progress</span>
          </label>
        </div>
        <div>
          <label class="inline-flex items-center">
            <input type="radio"
                   wire:model="status"
                   name="status"
                   value="4"
                   class="bg-gray-200 border-none text-green">
            <span class="ml-2">Implemented</span>
          </label>
        </div>
        <div>
          <label class="inline-flex items-center">
            <input type="radio"
                   wire:model="status"
                   name="status"
                   value="5"
                   class="bg-gray-200 border-none text-red">
            <span class="ml-2">Closed</span>
          </label>
        </div>
      </div>
      <div>
        <textarea name="update_comment"
                  wire:model="update_comment"
                  id="update_comment"
                  cols="30"
                  rows="3"
                  class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                  placeholder="Add an update comment (optional)"></textarea>
      </div>
      <div class="flex items-center justify-between space-x-3">
        <button type="button"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
          <svg class="text-gray-600 w-4 transform -rotate-45"
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
        <button type="submit"
                class="text-white w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 disabled:opacity-50">
          Update
        </button>
      </div>
      <div>
        <label class="inline-flex items-center font-normal">
          <input type="checkbox"
                 wire:model="notifyAllVoters"
                 name="notify_voters"
                 class="rounded bg-gray-200">
          <span class="ml-2">Notify all voters</span>
        </label>
      </div>
    </form>
  </div>
</div>