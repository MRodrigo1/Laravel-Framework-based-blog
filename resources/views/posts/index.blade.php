<x-layout>
    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
            <x-blog-posts :posts="$posts" />

            {{ $posts->links() }}

        @endif
    </main>

    {{-- @foreach ($posts ?? [] as $post)
    <article>
        <h1>
            <a href="/posts/{{ $post->slug }}">
    {!! $post->title; !!}
    </a>
    </h1>
    By <a href="/authors/{{ $post->author->username }}"> {{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
    <div>
        <p>
            {!! $post->excerpt; !!}
        </p>
    </div>
    </article>
    @endforeach --}}
</x-layout>
