<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;

    public $title, $content, $category_id = '';

    public $selectedTags = [];

    public $posts;

    public $postEdit = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];

    public $postEditId = '';

    public $open = false;

    public function save () {
        // $post = Post::create([
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'category_id' => $this->category_id,
        // ]);

        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->attach($this->selectedTags);

        $this->reset(['title', 'content', 'category_id', 'selectedTags']);
        $this->posts = Post::all();

    }

    public function edit($postId) {
        $this->open = true;

        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->postEdit['category_id'] = $post->id;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }

    public function update () {
        $post = Post::find($this->postEditId);

        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'title' => $this->postEdit['title'],
            'content' => $this->postEdit['content'],
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
