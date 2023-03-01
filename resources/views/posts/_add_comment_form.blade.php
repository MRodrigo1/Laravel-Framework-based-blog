@auth
{{-- _ faz com que seja partial --}}
<x-panel>
    <form method="POST" action="/posts/{{ $post->slug }}/comments">
        @csrf
        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40" class="rounded-full">
            <h2 class="ml-4">Want to participate?</h2>
        </header>
        <div class="mt-6">
            <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" cols="30" rows="5"
                placeholder="Write something exciting!" required></textarea>
        </div>
        @error('body')
        <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
            <x-form.submit-button>Post </x-form.submit-button>
        </div>
    </form>
</x-panel>
@else
<p class="font:semibold"> <a href="/login" class="hover:underline">Login to participate in the comments!</a></p>
@endauth