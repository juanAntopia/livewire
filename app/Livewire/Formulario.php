<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;

use function PHPUnit\Framework\throwException;

class Formulario extends Component
{
    public $categories, $tags;

    //validación
    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    public $posts;

    public function save () {
        $this->postCreate->save();
        $this->posts = Post::all();
        $this->dispatch('post-status', 'Nuevo post creado!');
    }

    public function edit($postId) {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }

    public function update () {
        $this->postEdit->update();
        $this->posts = Post::all();
        $this->dispatch('post-status', 'Post Actualizado!');
    }

    public function destroy($postId) {
        $post = Post::find($postId);

        $post->delete();

        $this->posts = Post::all();
        $this->dispatch('post-status', 'Post Eliminado!');
    }

    //ciclo de vida de un componente
    public function mount() {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function updating($property, $value) {
        if($property === 'postCreate.category_id') {
            if($value > 3) {
                throw new \Exception('No puedes seleccionar esta categoría');
            }
        }
        dd($property);
    }

    public function updated($property, $value)
    {
        dd($value);
    }

    public function hydrate () {
        //pendientes por agregar en ejemplos
    }

    public function dehydrate () {
        //pendientes por agregar en ejemplos 
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
