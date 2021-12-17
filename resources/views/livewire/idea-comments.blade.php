<div>
    @if ($comments->isNotEmpty())
    <div class="comments-container space-y-6 md:ml-22 my-8 relative pt-4">
        @foreach ($comments as $comment)
        <livewire:idea-comment
            :key="$comment->id"
            :comment="$comment"
        />
        @endforeach
    </div>
    @else
    <div class="mx-auto w-70 mt-12">
        <img
            src="https://raw.githubusercontent.com/laracasts/lc-voting/8fa083a3b8034e90b3c05b2d8e569e30721ac7d8/public/img/no-ideas.svg"
            alt="No Results"
            class="mx-auto mix-blend-luminosity"
        >
        <div class="text-gray-400 text-center font-bold mt-6">
            No comments yet.
        </div>
    </div>
    @endif
</div>