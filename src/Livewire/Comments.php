<?php

namespace Laraveldesign\Comments\Livewire;

use Laraveldesign\Comments\Models\Comment;
use Livewire\Component;

class Comments extends Component
{

    public $model;
    public $comment;

    public function mount($model) {
        $this->model = $model;
    }

    public function post() {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->model_class = get_class($this->model);
        $comment->model_id = $this->model->id;
        $comment->comment = $this->comment;
        $comment->save();
        $this->reset([
            'comment'
        ]);
    }

    public function render()
    {
        return view('comments::livewire.comments',
        [
            'comments'=>Comment::where([
                ['model_id','=',$this->model->id],
                ['model_class','=',get_class($this->model)]
            ])->get()
        ]);
    }
}
