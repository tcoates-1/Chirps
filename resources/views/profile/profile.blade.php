<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <img src="{{ $user->profile_image }}" alt="Current Profile Picture" class="h-24 w-24 object-cover rounded-full mx-3" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
            <h1 class=" align-middle text-3xl text-blue-600 leading-tight">
                {{ $user->username }} Profile
            </h1>
            <h1 class="text-center text-blue-600 text-3xl">Total Chirps: {{ $user->chirps_count }}</h1>
            <h1 class="text-center text-blue-600 text-3xl">Chirperversary: {{ $user->created_at->format('M d, Y') }}</h1>
        </div>
    </x-slot>
    <div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8">
		<form method="POST" action="{{ route('chirps.store') }}">
			@csrf
			<textarea
				name="message"
				placeholder="{{ __('What\'s on your mind?') }}"
				class="block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
			>{{ old('message') }}</textarea>
			<x-input-error :messages="$errors->get('message')" class="mt-2" />
			<x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
		</form>
    </div>
    
    <div class="flex justify-self-center place-content-center">
        <h1 class=" font-semibold text-blue-500 text-3xl underline">{{ $user->name }}'s Chirps:</h1>
    </div>        
    
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($chirps->reverse() as $chirp)
               <div class="p-6 flex space-x-2">
                <img src="{{ $chirp->user->profile_image }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full mx-auto" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">     
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($chirp->created_at->eq($chirp->updated_at))
                                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                 @if ($chirp->user->is(auth()->user()))
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                                        {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                {{ __('Delete') }}
                                                        </x-dropdown-link>
                                                    </form>
                                            </x-slot>
                                    </x-dropdown>
                                @endif
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                </div>
        </div>
    @endforeach
</div>
</x-app-layout>