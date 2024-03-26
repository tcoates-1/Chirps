<x-app-layout>
    <x-slot name="header">
        <x-profile.card :user="$user" class="border-blue-500" />
    </x-slot>

    <x-chirp-bar />
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <div class="flex justify-self-center place-content-center">
                    <h1 class=" font-semibold text-blue-500 text-3xl underline">{{ $user->name }}'s Chirps:</h1>
                </div>        

                <div>
                    <x-chirps.chirp-list :chirps="$chirps" /> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>