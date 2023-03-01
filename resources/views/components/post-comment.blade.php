@props(['comment'])

<article class="flex bg-gray-100 p-6 rounded-xl border-gray-200 space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" width="60" height="60" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <strong class="Font-bold">{{ $comment->author->username }}</strong>
            <p class="text-xs">Posted 
                <time>{{ $comment->created_at->format("F j, Y, g:i a ") }}</time>
            </p>
        </header>
        <p> {{ $comment->body }} </p>
    </div>
</article>