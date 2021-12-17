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

  <livewire:idea-comments :idea="$idea" />

  <x-notification-success />

  <x-modals-container :idea="$idea" />
</x-app-layout>