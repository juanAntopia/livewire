<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostCreateForm extends Form
{
    //validación de campos
    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule(['category_id' => 'required|exists:categories,id'], [], ['category_id' => 'categoría'])]
    public $category_id = '';

    #[Rule('required|array')]
    public $tags = [];

    public function save()
    {
        $this->validate();

        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->attach($this->tags);

        $this->reset();
    }
}
