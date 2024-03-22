<x-app-layout>
	<x-chirp-bar />
	<div class="flex justify-self-center place-content-center">
        <h1 class="text-blue-500 text-3xl underline">Look What Your Friends Are Chirping</h1>
    </div>
	<div>
        <x-chirps.list :chirps="$chirps" />
    </div>
</x-app-layout>
