<?php
namespace Laraveldesign\Comments\Livewire;

use Illuminate\Support\Facades\Auth;
use Laraveldesign\Comments\Models\Comment;
use Livewire\Component;

class Comments extends Component {

    public $comment;
    public $model_id;
    public $model_class;
    public $limit = 2;
    public $showMoreButton = false;
    public $total_comments;
    public $model;


    protected $rules = [
        'comment'=>'required'
    ];

    public function mount($model,$model_class = null) {
        $this->model = $model;
        $this->model_id = $model->id;
        if(!$model_class) {
          $this->model_class = get_class($model);
        } else {
          $this->model_class = $model_class;
        }
        $this->calculate();
    }

    public function delete($id) {
        if(Auth::check()) {
            $comment = Comment::findOrFail($id);
            if($comment->user_id == auth()->user()->id){
                $comment->delete();
            }
            if($comment->model_user_id == auth()->user()->id) {
                $comment->delete();
            }
            $this->render();
        }

    }

    public function more() {
        $this->limit += 5;
        $this->calculate();
    }

    public function commentCount() {
        return Comment::where([
            'model_id'=>$this->model_id,
            'model_class'=>$this->model_class
        ])->count();
    }

    public function calculate() {
        $this->showMoreButton = $this->commentCount() > $this->limit;
    }

    public function save() {
        if(Auth::check()) {
            $this->validate();
            Comment::create([
                'user_id'=>auth()->user()->id,
                'model_id'=>$this->model_id,
                'model_class'=>$this->model_class,
                'comment'=>$this->comment,
                'model_user_id'=>$this->model->user_id
            ]);
            $this->reset([
                'comment'
            ]);
            $this->calculate();
        }

    }

    public function render() {
        return view('comments::livewire.comments',[
            'comments'=>Comment::where([
                'model_id'=>$this->model_id,
                'model_class'=>$this->model_class
            ])->orderBy('created_at','desc')->limit($this->limit)->get()
        ]);
    }
}
