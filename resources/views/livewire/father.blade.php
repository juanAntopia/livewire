<div>
    {{-- The Master doesn't talk, he acts. --}}

    @persist('player')
    <video src="{{ asset('assets/videos/Video-1280x720.mp4') }}" type="video/mp4" width="450" height="450" 
        playsinline loop muted controls></video>
    @endpersist
    <h1 class="text-2xl font-semibold">
        Soy el componente padre
    </h1>
    <x-input wire:model.live="name"></x-input>
    <hr class="my-9">
    <div class="">
        {{-- @livewire('children', [
            'name' => $name
        ]) esta es una opción, aqui no se puede se bidireccional -1 --}}

        {{-- <livewire:children wire:model="name"/>  funciona de manera bidireccional pero con un solo prop --}}

        {{-- @livewire('contador', [], key('contador-1'))
        @livewire('contador', [], key('contador-2'))
        @livewire('contador', [], key('contador-3'))
        @livewire('contador', [], key('contador-4'))
        @livewire('contador', [], key('contador-5'))
        <livewire:contador key="contador-6" /> --}}

        <x-button wire:click="prueba">Prueba</x-button>

        {{-- <script lang="js"> //se puede agregar data-navigate-once para ejecutarse una sola vez estas funciones no se usan mucho
            // document.addEventListener('DOMContentLoaded', function(){
            //     console.log('hola desde componente padre')
            // })

            // document.addEventListener('livewire:navigated', function(){
            //     console.log('hola desde componente padre watch')
            // })
        </script> --}}

        @push('js')
            <script lang="js">
                let a = 'Juan';
                console.log('Esta es la manera mejor para trabajar js')
                
            </script>
        @endpush
    </div>
</div>
