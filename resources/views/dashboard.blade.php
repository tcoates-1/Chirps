<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Hey {{ $user->name }}! You're Logged in!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($sortedChirps as $chirp)
                        <x-chirps.chirp-card :chirp="$chirp"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
