<div {{attributes->merge(['class'=>'card']) }}>
    </div class="card-header">
        {{ $title }}
    </div>
    <div>
        {{ slot }}
    </div>
</div>