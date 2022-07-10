<div>

    <div style="text-align: center">
        <button wire:click="changeTerm('short_term')">+</button>
        <button wire:click="changeTerm('medium_term')">+</button>
        <button wire:click="changeTerm('long_term')">+</button>
        <h1>{{ $term }}</h1>
    </div>

</div>
