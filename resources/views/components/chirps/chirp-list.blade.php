<div {{$attributes->merge(['class'=>"mt-6 bg-white shadow-sm rounded-lg border rounded-lg"]) }}>
    @foreach ($chirps as $chirp)
        <x-chirps.chirp-card :chirp="$chirp"/>
    @endforeach
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        renderComments();
        deleteComments();
        renderReplies();
    })
</script>