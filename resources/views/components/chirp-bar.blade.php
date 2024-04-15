<div {{$attributes->merge(['class'=>"lg:mx-96 p-4 sm:p-4"]) }}>
    <form method="POST" action="{{ route('chirps.store') }}">
        @csrf
        <div class="relative">
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-blue-500 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-3 mb-3">{{ __('Chirp') }}</x-primary-button>
        </div>
    </form>
</div>