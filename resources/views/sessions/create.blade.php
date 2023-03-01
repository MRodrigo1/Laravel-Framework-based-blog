<x-layout>
    <section class="px-6 py-8">
        <main class ="max-w-lg mx-auto mt-10" >
            <x-panel>
            <h1 class="text-center font-bold text-xl ">Log In</h1>
            <form method="POST" action="/sessions" class="mt-10">
                @csrf 
                {{-- Token para evitar cross domain request forms --}}
                <x-form.input name="email" type="email" autocomplete="username"/>
                <x-form.input name="password" type="password" autocomplete="username"/>
                <x-form.submit-button>Log In</x-form.submit-button>
        {{-- secção do fim --}}
        
        @if($errors->any())
        <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
        </ul>
        @endif
            </form>
        </x-panel>
        </main>
    </section>
</x-layout>