<div {{$attributes->merge(['class'=>'card flex items-center justify-between']) }}>
    <div>
        <img src="{{ $user->profile_image }}" alt="Current Profile Picture" class="h-24 w-24 object-cover rounded-full mx-3" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
    </div>
    <h1 class="card-header align-middle text-3xl text-blue-600 leading-tight">
        {{ $user->username }} Profile
    </h1>
    <h1 class="text-center text-blue-600 text-3xl">
        Total Chirps: {{ $user->chirps_count }}
        Chirperversary: {{ $user->created_at->format('M d, Y') }}
    </h1>
</div>

<div class="flex items-center justify-between">
    <img src="{{ $user->profile_image }}" alt="Current Profile Picture" class="h-24 w-24 object-cover rounded-full mx-3" onerror="this.onerror=null; this.src='{{ asset('images/Lake.jpg') }}'; this.alt='image default';">
    <h1 class=" align-middle text-3xl text-blue-600 leading-tight">
        {{ $user->username }} Profile
    </h1>
    <h1 class="text-center text-blue-600 text-3xl">Total Chirps: {{ $user->chirps_count }}</h1>
    <h1 class="text-center text-blue-600 text-3xl">Chirperversary: {{ $user->created_at->format('M d, Y') }}</h1>
</div>