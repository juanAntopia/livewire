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

    #[Rule('nullable|image|max:1024')]
    public $image;

    public $imageKey;

    public function save()
    {
        $this->validate();

        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->attach($this->tags);

        if($this->image) {
            $post->image_path = $this->image->store('posts');
            $post->save();
        }

        $this->imageKey = rand();

        $this->reset();
    }
}
