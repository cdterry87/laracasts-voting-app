@props([
'redirect' => false,
'messageToDisplay' => ''
])

<div
  x-cloak
  x-data="{
    isOpen: false,
    messageToDisplay: '{{ $messageToDisplay }}',
    showNotification (message) {
      this.isOpen = true
      this.messageToDisplay = message
      setTimeout(() => {
        this.isOpen = false
      }, 3000)
    }
  }"
  x-show="isOpen"
  x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform translate-x-8"
  x-transition:enter-end="opacity-100 transform translate-x-0"
  x-transition:leave="transition ease-in duration-300"
  x-transition:leave-start="opacity-100 transform translate-x-0"
  x-transition:leave-end="opacity-0 transform translate-x-8"
  x-init="
    @if($redirect)
      $nextTick(() => showNotification(messageToDisplay))
    @else
      Livewire.on('ideaUpdated', (message) => {
        showNotification(message)
      })

      Livewire.on('ideaMarkedAsSpam', (message) => {
        showNotification(message)
      })

      Livewire.on('ideaMarkedAsNotSpam', (message) => {
        showNotification(message)
      })

      Livewire.on('commentAdded', (message) => {
        showNotification(message)
      })

      Livewire.on('commentUpdated', (message) => {
        showNotification(message)
      })
    @endif
  "
  @keydown.escape.window="isOpen = false"
  class="flex justify-between items-center fixed right-0 bottom-0 bg-white rounded-xl shadow-lg border px-6 py-5 mx-6 my-8 gap-8 z-20"
>
  <div class="flex items-center gap-2">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-6 w-6 text-green"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
    <div
      class="font-semibold text-gray-500 text-sm md:text-base"
      x-text="messageToDisplay"
    >

    </div>
  </div>
  <button
    @click.prevent="isOpen = false"
    class="text-gray-400 hover:text-gray-600"
  >
    <svg
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
        d="M6 18L18 6M6 6l12 12"
      />
    </svg>
  </button>
</div>