<x-app-layout>
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
        <div class="flex justify-self-center place-content-center">
            <h1 class="text-blue-500 text-3xl underline">All Chirpers!</h1>
        </div>
        
		<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-blue-500">Profile Picture</th>
                        <th class="text-blue-500">Name</th>
                        <th class="text-blue-500">Account Created</th>
                        <th class="text-blue-500">Chirp Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center"><img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="h-16 w-16 object-cover rounded-full mx-auto"></td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-center">{{ $user->chirps_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>	 
        </div>
	</div>
</x-app-layout>