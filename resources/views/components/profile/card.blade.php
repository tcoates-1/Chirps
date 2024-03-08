<div {{$attributes->merge(['class'=>'grid grid-cols-2 gap-4 border rounded-lg p-2']) }}>
    <!-- First Row -->
    <div class="flex">
        <a href="{{ route('profile.show', ['username' => $user->username]) }}">
            <img src="{{ $user->profile_image }}" alt="Current Profile Picture" class="md:h-24 md:w-24 h-12 w-12 object-cover rounded-full mr-3 transform hover:scale-125 min-w-10 min-h-10" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
        </a>
        <div>
            <h1 class="align-middle md:text-3xl text-blue-600 leading-tight hover:font-bold">
                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                    {{ $user->username }}
                </a>
            </h1>
        </div>
    </div>
    <div class="shrink justify-end col-start-2">
        <h1 class="text-right md:text-3xl text-blue-600 leading-tight hover:font-bold">
            <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                {{ $user->name }}
            </a>
        </h1>
    </div>

    <!-- Second Row (Total Chirps and Chirperversary) -->
    <div class="row-start-2 col-start-1 text-left text-blue-600 md:justify-self-center md:text-3xl">
        Total Chirps:
    </div>
    <div class="row-start-2 col-start-1 text-right text-blue-600 md:text-3xl">
        {{ $user->chirps_count }}
    </div>
    <div class="row-start-2 col-span-1 text-right text-blue-600 md:text-3xl">
        Chirperversary: {{ $user->created_at->format('M d, Y') }}
    </div>
</div>