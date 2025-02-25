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
                    <option value="Selecciona una categoría">Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.category_id"></x-input-error>

            </div>

            <div class="mb-4">
                <x-label>Etiquetas</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label for="">
                                <x-checkbox wire:model.live="postCreate.tags" id="" value="{{ $tag->id }}" />
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
                        <option value="Selecciona una categoría">Selecciona una categoría</option>
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
</div>
