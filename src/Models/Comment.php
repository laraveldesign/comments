<?php
namespace Laraveldesign\Comments\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $fillable = [
        'user_id',
        'model_id',
        'model_class',
        'comment'
    ];

}
