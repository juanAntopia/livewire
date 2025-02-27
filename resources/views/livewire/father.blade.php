<div>
    {{-- The Master doesn't talk, he acts. --}}
    <h1 class="text-2xl font-semibold">
        Soy el componente padre
    </h1>
    <x-input wire:model.live="name"></x-input>
    <hr class="my-9">
    <div class="">
        {{-- @livewire('children', [
            'name' => $name
        ]) esta es una opción, aqui no se puede se bidireccional -1 --}}

        <livewire:children wire:model="name"/>  {{--funciona de manera bidireccional pero con un solo prop --}}

        {{-- @livewire('contador', [], key('contador-1'))
        @livewire('contador', [], key('contador-2'))
        @livewire('contador', [], key('contador-3'))
        @livewire('contador', [], key('contador-4'))
        @livewire('contador', [], key('contador-5'))
        <livewire:contador key="contador-6" /> --}}
    </div>
</div>
