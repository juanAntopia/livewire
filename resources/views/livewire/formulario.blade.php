<div>
    <div class="bg-white p-6 shadow rounded-lg mb-8">
        <form wire:submit="save">
            <div class="mb-4">
                <x-label>Nombre</x-label>
                <x-input class="w-full" wire:model.live="postCreate.title"></x-input>

                <x-input-error for="postCreate.title"></x-input-error>
            </div>

            <div class="mb-4">
                <x-label>Contenido</x-label>
                <x-textarea class="w-full" wire:model.live="postCreate.content"></x-textarea>
                <x-input-error for="postCreate.content"></x-input-error>
            </div>

            <div class="mb-4">
                <x-label>Categorías</x-label>
                <x-select class="w-full" wire:model.live="postCreate.category_id">
                    <option value="Selecciona una categoría" disabled>Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.category_id"></x-input-error>
            </div>

            <div class="mb-4 flex">
                <x-label for="image_path">Selecciona un archivo</x-label>
                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <input type="file" id="image_path" wire:model="postCreate.image"
                        wire:key="{{ $postCreate->imageKey }}">

                    <div x-show="uploading">
                        <div x-text="progress"></div>
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

                <div>
                    @if ($postCreate->image)
                        <img src="{{ $postCreate->image->temporaryUrl() }}" alt="" width="150px"
                            height="150px">
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <x-label>Etiquetas</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label for="">
                                <x-checkbox wire:model.live="postCreate.tags" id=""
                                    value="{{ $tag->id }}" />
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
                <x-input-error for="postCreate.tags"></x-input-error>
            </div>

            <div class="flex justify-end">
                <x-button>Crear</x-button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 shadow rounded-lg">
        <ul class="list-disc list-inside space-y-2">
            @foreach ($posts as $post)
                <li class="flex justify-between" wire:key="post-{{ $post->id }}">
                    {{ $post->title }}

                    <div>
                        <x-button wire:click="edit({{ $post->id }})">Editar</x-button>
                        <x-danger-button wire:click="destroy({{ $post->id }})">Eliminar</x-danger-button>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>

    {{-- formulario para editar --}}
    <form wire:submit="update">
        <x-dialog-modal wire:model="postEdit.open">
            <x-slot name="title">
                Actualizar Post
            </x-slot>

            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model.live="postEdit.title"></x-input>
                    <x-input-error for="postEdit.title"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-label>Contenido</x-label>
                    <x-textarea class="w-full" wire:model.live="postEdit.content"></x-textarea>
                    <x-input-error for="postEdit.content"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-label>Categorías</x-label>
                    <x-select class="w-full" wire:model.live="postEdit.category_id">
                        <option value="Selecciona una categoría" disabled>Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.category_id"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul>
                        @foreach ($tags as $tag)
                            <li>
                                <label for="">
                                    <x-checkbox wire:model.live="postEdit.tags" wire:key="tag-{{ $tag->id }}"
                                        id="" value="{{ $tag->id }}" />
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="postEdit.tags"></x-input-error>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button class="mr-2" wire:click="$set('postEdit.open', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button>Actualizar</x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>

    @push('js')
        <script>
            Livewire.on('post-status', function(comment) {
                console.log(comment[0])
            })
        </script>
    @endpush
</div>
