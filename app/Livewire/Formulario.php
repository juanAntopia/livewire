<?php

namespace App\Livewire;

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
    public $postCreate = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public $posts;

    public $postEdit = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public $postEditId = '';

    public $open = false;

    public function rules() {
        return [
            'postCreate.title' => 'required',
            'postCreate.content' => 'required',
            'postCreate.category_id' => 'required|exists:categories,id',
            'postCreate.tags' => 'required|array'
        ];
    }

    public function messages (){
        return [
            'postCreate.title.required' => 'El campo título es requerido.',
            'postCreate.content.required' => 'El campo contenido es requerido.',
            'postCreate.category_id.required' => 'El campo categoría es requerido.',
            'postCreate.tags.required' => 'El campo etiquetas es requerido.'
        ];
    }

    public function validationAttributes () {
        return [
            'postCreate.title' => 'título',
            'postCreate.content' => 'contenido',
            'postCreate.category_id' => 'categoría',
            'postCreate.tags' => 'etiquetas'
        ];
    }

    public function save () {
        //otra forma de validar
        $this->validate();

        //validación -- esta validación es permitida en laravel sin livewire
        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'selectedTags' => 'required|array'
        // ], [
        //     'title.required' => 'El campo Título es requerido'
        // ], [
        //     'category_id' => 'categoría'
        // ]);

        // $post = Post::create([
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'category_id' => $this->category_id,
        // ]);

        $post = Post::create([
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content'],
            'category_id' => $this->postCreate['category_id'],
        ]);

        $post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);
        $this->posts = Post::all();

    }

    public function edit($postId) {
        $this->resetValidation();
        
        $this->open = true;

        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;
        $this->postEdit['category_id'] = $post->id;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }

    public function update () {
        $this->validate([
            'postEdit.title' => 'required',
            'postEdit.content' => 'required',
            'postEdit.category_id' => 'required|exists:categories,id',
            'postEdit.tags' => 'required|array'
        ], [], [
            'postEdit.title' => 'título',
            'postEdit.content' => 'contenido',
            'postEdit.category_id' => 'categoría',
            'postEdit.tags' => 'etiquetas'
        ]);

        $post = Post::find($this->postEditId);

        $post->update([
            'title' => $this->postEdit['title'],
            'content' => $this->postEdit['content'],
            'category_id' => $this->postEdit['category_id'],
        ]);

        $post->tags()->sync($this->postEdit['tags']);

        $this->reset(['postEdit', 'postEditId', 'open']);

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
