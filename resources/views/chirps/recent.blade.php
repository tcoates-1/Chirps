<x-app-layout>
	<x-chirp-bar />
	<div class="flex justify-self-center place-content-center">
        <h1 class="text-blue-500 text-3xl underline">Chirps From the Last 14 Days</h1>
    </div>
	<div>
        <x-chirps.chirp-list :chirps="$chirps" />
	</div>
</x-app-layout>
