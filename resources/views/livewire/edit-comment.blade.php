<div x-cloak
     x-data="{ isOpen: false }"
     x-show="isOpen"
     x-init="
        Livewire.on('commentUpdated', () => {
            isOpen = false
        })
        Livewire.on('editCommentWasSet', () => {
            isOpen = true
            $nextTick(() => $refs.body.focus())
        })
    "
     @keydown.escape.window="isOpen = false"
     class="fixed z-10 inset-0 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">
    <div class="flex items-end justify-center min-h-screen ">
        <div x-show="isOpen"
             x-transition.opacity
             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
             aria-hidden="true"></div>
        <div @click.away="isOpen = false"
             x-show="isOpen"
             x-transition.origin.bottom.duration.400ms.ease-in-out
             class="modal bg-white rounded-tl-xl rounded-tr-xl overflow-hidden transform transition-all py-4 sm:max-w-lg sm:w-full">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button @click="isOpen = false"
                        class="text-gray-400 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-center text-lg font-medium text-gray-900">Edit Comment</h3>

                <form wire:submit.prevent="updateComment"
                      class="space-y-4 px-4 py-6">
                    <div>
                        <textarea wire:model.defer="body"
                                x-ref="body"
                                  name="body"
                                  id="body"
                                  cols="30"
                                  rows="4"
                                  class="w-full rounded-xl border-none bg-gray-100 placeholder-gray-900 text-sm py-2 px-4"
                                  placeholder="Edit your comment"
                                  required></textarea>
                        @error('body')
                        <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
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
                                class="text-white w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>