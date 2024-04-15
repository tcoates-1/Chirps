<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/Twitter.webp') }}" alt="logo" class="h-10 w-10 object-contain rounded-md mx-auto hover:scale-125"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.show', ['username' => Auth::user()->username])" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-nav-link>
		            <x-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
			            {{ __('Chirps') }}
		            </x-nav-link>
                    <x-nav-link :href="route('recent')" :active="request()->routeIs('recent')">
			            {{ __('Recent Chirps') }}
		            </x-nav-link>
                    <x-nav-link :href="route('chirpers.index')" :active="request()->routeIs('chirpers.index')">
			            {{ __('Chirpers') }}
		            </x-nav-link>
                    <x-nav-link :href="route('notification.index')" :active="request()->routeIs('notification.index')">
			            {{ __('Notifications') }}
		            </x-nav-link>
               </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative hover:cursor-pointer" id="notificationDropdown">
                    <img class="h-14 w-14 hover:scale-110" src="{{ url('images/notification-bell-icon.png') }}" alt="notification bell icon">
                    <span id="notificationCount" class="absolute top-0 right-2 text-red-500 font-bold text-lg px-w py-1 rounded-full">
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            {{ Auth::user()->unreadnotifications->count() }}
                        @endif</span>
                    <div class="absolute w-max top-full right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden z-50" id="notificationList">
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            @if ($notification->type == 'App\Notifications\NewFollower')
                                <a href="{{ route('profile.show', ['username' => $notification->data['follower_username']]) }}">
                                    <div class="p-2 hover:font-bold text-blue-500">
                                        {{ $notification->data['follower_name'] }} followed you! 
                                    </div>
                                </a>
                            @endif
                            @if ($notification->type == 'App\Notifications\NewComment')
                                <a href="{{ route('chirps.index') }}#{{ $notification->data['chirp_id'] }}">
                                    <div class="p-2 hover:font-bold text-blue-500">
                                        {{ $notification->data['commenter_name'] }} commented on your chirp!
                                    </div>
                                </a>
                            @endif
                            @if ($notification->type == 'App\Notifications\NewReply')
                                <a href="{{ route('chirps.index') }}#{{ $notification->data['parent_id'] }}">
                                    <div class="p-2 hover:font-bold text-blue-500">
                                        {{ $notification->data['commenter_name'] }} replied to your comment!
                                    </div>
                                </a>
                            @endif
                        @endforeach
                        <form id="markNotificationsAsReadForm" action="{{ route('mark-notifications-as-read') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-300 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
	    <x-responsive-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
		{{ __('Chirps') }}
	    </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('recent')" :active="request()->routeIs('recent')">
		{{ __('Recent Chirps') }}
	    </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('profile.show', ['username' => Auth::user()->username])" :active="request()->routeIs('profile.show')">
            {{ __('Profile') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('chirpers.index')" :active="request()->routeIs('chirpers.index')">
            {{ __('Chirpers') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('notification.index')" :active="request()->routeIs('notification.index')">
            {{ __('Notifications') }}
        </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    function updateNotificationCount() {
        const notiCount = document.getElementById('notificationCount');
        if (notiCount) {
            notiCount.classList.add('hidden')
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const markNotificationsAsReadForm = document.getElementById('markNotificationsAsReadForm');

        notificationDropdown.addEventListener('click', event => {
            notificationList.classList.toggle('hidden');
            fetch(markNotificationsAsReadForm.action, {
                method:"POST",
                body: new FormData(markNotificationsAsReadForm)
            })
            .then(response => {
                if (response.ok) {
                    updateNotificationCount();
                } else {
                    console.log('error');
                }
            })
        })

        document.addEventListener('click', event => {
            if (!notificationDropdown.contains(event.target)) {
                notificationList.classList.add('hidden');
            }
        })
    })
    
</script>