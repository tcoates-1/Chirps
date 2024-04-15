<x-app-layout>
	<div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-self-center place-content-center">
            <h1 class="text-white text-3xl underline">Notifications</h1>
        </div>
	</div>
    <div class="lg:grid lg:grid-cols-2 p-2 mt-6 bg-white shadow-sm">
        @foreach (Auth::user()->notifications as $notification)
            @if ($notification->type == 'App\Notifications\NewFollower')
            <a href="{{ route('profile.show', ['username' => $notification->data['follower_username']]) }}">
                <div class="flex p-2 m-2 text-white border rounded-lg bg-gradient-to-r from-blue-300 via-cyan-500 to-blue-800 justify-between">
                    <div class="hover:scale-105 hover:font-bold">
                        {{ $notification->data['follower_name'] }} followed you!
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($notification->created_at)->format('M d') }}
                    </div>
                </div>
            </a>
            @elseif ($notification->type == 'App\Notifications\NewComment')
                <a href="{{ route('chirps.index') }}#{{ $notification->data['chirp_id'] }}">
                    <div class="flex p-2 m-2 text-white border rounded-lg bg-gradient-to-r from-blue-300 via-cyan-500 to-blue-800 justify-between">
                        <div class="hover:scale-105 hover:font-bold">
                            {{ $notification->data['commenter_name'] }} commented on your chirp!
                        </div>
                        <div>
                            {{ \Carbon\Carbon::parse($notification->created_at)->format('M d') }}
                        </div>
                    </div>
                </a>
            @elseif ($notification->type == 'App\Notifications\NewReply')
                <a href="{{ route('chirps.index') }}#{{ $notification->data['parent_id'] }}">
                    <div class="flex p-2 m-2 text-white border rounded-lg bg-gradient-to-r from-blue-300 via-cyan-500 to-blue-800 justify-between">
                        <div class="hover:scale-105 hover:font-bold">
                            {{ $notification->data['commenter_name'] }} replied to your comment!
                        </div>
                        <div>
                            {{ \Carbon\Carbon::parse($notification->created_at)->format('M d') }}
                        </div>
                    </div>
                </a>
            @endif           
        @endforeach
    </div>
</x-app-layout>