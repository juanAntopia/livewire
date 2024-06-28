<div>
    <div>
        <x-button wire:click="decrement()">-</x-button>
        <p class="mx-3">
            {{ $contador }}
        </p>
        <x-button wire:click="increment(10)">+</x-button>
    </div>
</div>
