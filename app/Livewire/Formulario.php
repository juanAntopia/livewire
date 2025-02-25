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
    // #[Rule([
    //     'postCreate.title' => 'required',
    //     'postCreate.content' => 'required',
    //     'postCreate.category_id' => 'required|exists:categories,id',
    //     'postCreate.tags' => 'required|array'
    // ], [], [
    //     'postCreate.title' => 'título',
    //     'postCreate.content' => 'contenido',
    //     'postCreate.category_id' => 'categoría',
    //     'postCreate.tags' => 'etiquetas'
    // ])]
    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    public $posts;

    // public function rules() {
    //     return [
    //         'postCreate.title' => 'required',
    //         'postCreate.content' => 'required',
    //         'postCreate.category_id' => 'required|exists:categories,id',
    //         'postCreate.tags' => 'required|array'
    //     ];
    // }

    // public function messages (){
    //     return [
    //         'postCreate.title.required' => 'El campo título es requerido.',
    //         'postCreate.content.required' => 'El campo contenido es requerido.',
    //         'postCreate.category_id.required' => 'El campo categoría es requerido.',
    //         'postCreate.tags.required' => 'El campo etiquetas es requerido.'
    //     ];
    // }

    // public function validationAttributes () {
    //     return [
    //         'postCreate.title' => 'título',
    //         'postCreate.content' => 'contenido',
    //         'postCreate.category_id' => 'categoría',
    //         'postCreate.tags' => 'etiquetas'
    //     ];
    // }

    public function save () {
        $this->postCreate->save();
        $this->posts = Post::all();
    }

    public function edit($postId) {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }

    public function update () {
        $this->postEdit->update();
        $this->posts = Post::all();
    }

    public function destroy($postId) {
        $post = Post::find($postId);

        $post->delete();

        $this->posts = Post::all();
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
