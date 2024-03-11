<x-app-layout>
	<x-chirp-bar />
	<div class="flex justify-self-center place-content-center">
        <h1 class="text-blue-500 text-3xl underline">Chirps From the Last 14 Days</h1>
    </div>
	<div>
        <x-chirp-list :chirps="$chirps" class="border-blue-500" />
	</div>
</x-app-layout>
