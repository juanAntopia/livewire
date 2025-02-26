<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

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

    public function mount() {
        $this->categories = Category::all();
        $this->tags = Tag::all();

        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
