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
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function PHPUnit\Framework\throwException;

class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;
    // use WithoutUrlPagination;

    public $categories, $tags;

    //validación
    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    // public $posts;

    public function save () {
        $this->postCreate->save();
        $this->resetPage(pageName:'pagePosts');
        $this->dispatch('post-status', 'Nuevo post creado!');
    }

    public function edit($postId) {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }

    public function update () {
        $this->postEdit->update();
        $this->dispatch('post-status', 'Post Actualizado!');
    }

    public function destroy($postId) {
        $post = Post::find($postId);

        $post->delete();

        $this->dispatch('post-status', 'Post Eliminado!');
    }

    // public function placeholder (){ no se ocupa porque lo definí en el archivo de configuración de livewire
    //     return view('livewire.placeholders.skeleton');
    // }

    //ciclo de vida de un componente
    public function mount() {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function updating($property, $value) {
        // if($property === 'postCreate.category_id') {
        //     if($value > 3) {
        //         throw new \Exception('No puedes seleccionar esta categoría');
        //     }
        // }
        // dd($property);
    }

    public function updated($property, $value)
    {
        // dd($value);
    }

    public function hydrate () {
        //pendientes por agregar en ejemplos
    }

    public function dehydrate () {
        //pendientes por agregar en ejemplos 
    }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5, pageName: 'pagePosts');
        return view('livewire.formulario', compact('posts'));
    }
}
