<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('prueba') }}
        </h2>
    </x-slot>


    @persist('player')
    <video src="{{ asset('assets/videos/Video-1280x720.mp4') }}" type="video/mp4" width="450" height="450"
        playsinline loop muted controls></video>
    @endpersist
</x-app-layout>