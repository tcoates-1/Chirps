<x-app-layout>
	<div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-self-center place-content-center">
            <h1 class="text-white text-3xl underline">All Chirpers!</h1>
        </div>
        
	</div>
    <div>
        <div class="lg:grid lg:grid-cols-2 mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($users as $user)
                <div>
                    <x-profile.card :user="$user" class="mb-1 border-blue-500 mr-3 mt-3 ml-3 {{ $loop->even ? 'col-start-1' : 'col-start-2' }}" />
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>