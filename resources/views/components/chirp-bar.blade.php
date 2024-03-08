<div {{$attributes->merge(['class'=>"max-w-full mx-auto p-4 sm:p-6 lg:p-8"]) }}>
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
    <div class="flex justify-self-center place-content-center">
        <h1 class="text-blue-500 text-3xl underline">Look What Your Friends Are Chirping</h1>
    </div>