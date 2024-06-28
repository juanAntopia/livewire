<div>
    <form wire:submit="save">
        <x-input placeholder="Ingrese un país" wire:model="pais"></x-input>
        <x-button>Agregar</x-button>
    </form>

    <ul class="list-disc list-inside mt-5">
        @foreach ($paises as $index => $pais)
            <li>
                ({{ $index }}) <span wire:mouseenter="changeActive('{{ $pais }}')">{{ $pais }}</span>  <x-danger-button class="ml-5" wire:click="delete({{ $index }})">x</x-danger-button>
            </li>
        @endforeach
    </ul>

    <div>
        {{ $active }}
    </div>
</div>
