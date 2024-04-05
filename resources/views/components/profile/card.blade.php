<div {{$attributes->merge(['class'=>'grid grid-cols-2 gap-4 border shadow-lg rounded-lg p-2 bg-gradient-to-r from-blue-800 via-cyan-500 to-blue-400']) }}>
    <!-- First Row -->
    <div class="flex">
        <a href="{{ route('profile.show', ['username' => $user->username]) }}">
            <img src="{{ $user->profile_image }}" alt="Current Profile Picture" class="md:h-24 md:w-24 h-12 w-12 object-cover rounded-full mr-3 transform hover:scale-125 min-w-10 min-h-10" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
        </a>
        <div>
            <h1 class="align-middle md:text-3xl text-white leading-tight hover:font-bold">
                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                    {{ $user->username }}
                </a>
            </h1>
        </div>
    </div>
    <div class="shrink justify-end col-start-2">
        <h1 class="text-right md:text-3xl text-white leading-tight hover:font-bold">
            <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                {{ $user->name }}
            </a>
        </h1>
        <div class="flex justify-end">
            <form method="POST" action="{{ route('profile.follow', $user->id) }}" class="text-right">
                @csrf
                <input type="hidden" name="userToFollow" value="{{ $user->id }}">
                <input type="hidden" name="userFollowing" value="{{ Auth::user() }}">
                <button type="submit" class="bg-white font-bold text-blue-500 py-1 px-2 m-1 rounded hover:bg-gray-300">Follow</button>
            </form>
            <form method="POST" action="{{ route('profile.unfollow', $user->id) }}" class="text-right">
                @csrf
                <input type="hidden" name="userToUnfollow" value="{{ $user->id }}">
                <input type="hidden" name="userUnfollowing" value="{{ Auth::user() }}">
                <button type="submit" class="bg-white font-bold text-blue-500 py-1 px-2 ml-1 mt-1 mb-1 mr-0 rounded hover:bg-gray-300">Unfollow</button>
            </form>
        </div>
        <div class="flex justify-end">
        @if(session('message') && session('user_id') == $user->id)
            <div class="flex bg-green-100 border border-green-400 text-green-700 px-1 py-1 rounded inline-block justify-center">
                <div>{{ session('message') }}</div>
            </div>
        @endif
        </div>
    </div>

    <!-- Second Row (Total Chirps and Chirperversary) -->
    <div class="row-start-2 col-start-1 text-left text-white md:justify-self-center md:text-3xl">
        Total Chirps:
    </div>
    <div class="row-start-2 col-start-1 text-right text-white md:text-3xl">
        {{ $user->chirps_count }}
    </div>
    <div class="row-start-2 col-span-1 text-right text-white md:text-3xl">
        Chirperversary: {{ $user->created_at->format('M d, Y') }}
    </div>
</div>

