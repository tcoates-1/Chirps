
<section>
    <header class="flex items-center">
        <!-- Display current profile picture if it exists -->
        @if(auth()->user()->profile_image)
            <img src="{{ auth()->user()->profile_image }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full mr-4">
        @endif 
        <h2 class="text-lg font-medium text-gray-900 ml-4"> {{ __('Add Profile Picture') }}</h2>

    </header>
    
    <form method="POST" action="{{ route('profile.profile_image') }}">
        @csrf
        @method('PUT')
    
        <x-input-label for="profile_image" :value="__('Enter the URL for your desired profile picture. Must be JPEG or PNG')" />
        <x-text-input id="profile_image" name="profile_image" type="text" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('profile_image', auth()->user()->profile_image) }}" />
    
        <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
    </form>
    
    
</section>