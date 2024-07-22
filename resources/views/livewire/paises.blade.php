<div>

    <div class="mb-5">
        {{-- @livewire('hijo') --}}
        <x-button wire:click="$set('count', 0)">resetear</x-button>
    </div>

    <form wire:submit="save">
        <x-input placeholder="Ingrese un país" wire:model="pais" wire:keydown="increment"></x-input>
        <x-button>Agregar</x-button>
    </form>

    <x-button wire:click="$toggle('openPaises')" class="mt-5">Mostrar/Ocultar</x-button>

    @if ($openPaises)
        <ul class="list-disc list-inside mt-5">
            @foreach ($paises as $index => $pais)
            <li>
                ({{ $index }}) <span wire:mouseenter="changeActive('{{ $pais }}')">{{ $pais }}</span>  <x-danger-button class="ml-5" wire:click="delete({{ $index }})">x</x-danger-button>
            </li>
            @endforeach
        </ul>
    @endif

    <div>
        {{ $active }}
    </div>

    <div>
        {{ $count }}
    </div>
</div>
