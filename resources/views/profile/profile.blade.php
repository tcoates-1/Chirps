<x-app-layout>
    <x-slot name="header">
        <x-profile.card :user="$user" class="border-blue-500" />
    </x-slot>
    <x-chirp-bar />
    
    <div class="flex justify-self-center place-content-center">
        <h1 class=" font-semibold text-blue-500 text-3xl underline">{{ $user->name }}'s Chirps:</h1>
    </div>        

    <div>
        <x-chirp-list :chirps="$chirps" class="border-blue-600" />
    </div>
</x-app-layout>