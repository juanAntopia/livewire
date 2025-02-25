<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostEditForm extends Form
{
    public $postEditId = '';
    public $open = false;

    //validar campos
    #[Rule(['title' => 'required'], [], [])]
    public $title;

    #[Rule(['content' => 'required'], [], [])]
    public $content;

    #[Rule(['category_id' => 'required|exists:categories,id'], [], ['category_id' => 'categoría'])]
    public $category_id;

    #[Rule(['tags' => 'required'], [], [])]
    public $tags = [];

    public function edit($postId)
    {
        $this->resetValidation();

        $this->open = true;

        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->title = $post->title;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->tags = $post->tags->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->postEditId);

        $post->update(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->sync($this->tags);

        $this->reset();
    }
}
