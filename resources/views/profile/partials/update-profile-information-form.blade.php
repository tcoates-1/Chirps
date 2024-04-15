<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    @if(session('message'))
        <div class="inline-flex bg-green-100 border border-green-400 text-green-700 px-1 py-1 rounded inline-block justify-center">
            <div>{{ session('message') }}</div>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div>
            <header class="flex items-center">
                <!-- Display current profile picture if it exists -->
                @if(auth()->user()->profile_image)
                    <h2 class="text-lg font-medium text-gray-900"> {{ __('Current Profile Picture') }}</h2>
                    <img src="{{ auth()->user()->profile_image }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full ml-4">                    
                @else
                    <h2 class="text-lg font-medium text-gray-900"> {{ __('Add Profile Picture') }}</h2>
                    <img src="{{ asset('images/Lake.jpg') }}" alt="Current Profile Picture" class="h-16 w-16 object-cover rounded-full ml-4">
                @endif 
            </header>

            <div class="relative">
                <x-input-label for="profile_image" :value="__('Upload Profile Picture')" />
                <input id="profile_image" name="profile_image" type="file" accept="image/*" class="mt-1 block w-full absolute hidden" onchange="updateFileName(this)">
                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
                <label for="profile_image" id="fileInputLabel" class="inline-block p-2 bg-blue-500 text-white cursor-pointer w-auto rounded-md text-center hover:bg-blue-800 shadow-md shadow-blue-500/50">Choose File</label>
            </div>

        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
<script>
    function updateFileName(input) {
        const fileName = input.files[0].name
        const label = document.getElementById('fileInputLabel');
        label.textContent = fileName;
    }
</script>