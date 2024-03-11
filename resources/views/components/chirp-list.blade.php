<div {{$attributes->merge(['class'=>"mt-6 bg-white shadow-sm rounded-lg divide-y border"]) }}>
    @foreach ($chirps as $chirp)
        <div class="p-6 flex space-x-2 border-blue-600">
            <a href="{{ route('profile.show', ['username' => $chirp->user->username]) }}">
                <img src="{{ $chirp->user->profile_image }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full mx-auto hover:scale-125" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">     
            </a>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                            <div>
                                <a href="{{ route('profile.show', ['username' => $chirp->user->username]) }}">
                                    <span class="text-gray-800 hover:font-bold hover:text-blue-600">{{ $chirp->user->name }}</span>
                                </a>
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