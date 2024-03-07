<x-app-layout>
	<div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-self-center place-content-center">
            <h1 class="text-blue-500 text-3xl underline">All Chirpers!</h1>
        </div>
        
		<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-blue-500">Profile Picture</th>
                        <th class="text-blue-500">Name</th>
                        <th class="text-blue-500">UserName</th>
                        <th class="text-blue-500">Account Created</th>
                        <th class="text-blue-500">Chirp Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                    <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="h-16 w-16 object-cover rounded-full mx-auto transform hover:scale-125" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
                                </a>
                            </td>
                            <td class="text-center hover:text-blue-600 hover:font-bold">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="text-center hover:text-blue-600 hover:font-bold">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                     {{ $user->username }}
                                </a>
                            </td>
                            <td class="text-center">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-center">{{ $user->chirps_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>	 
        </div>
	</div>
</x-app-layout>