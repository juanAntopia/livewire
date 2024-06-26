<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <h1>{{ $title }}</h1>

    <x-input type="text" wire:model.live="name"></x-input>
    <x-button wire:click="save()">Save</x-button>

    <h2>{{ $name }}</h2>
</div>
