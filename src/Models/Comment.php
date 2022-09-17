<?php

namespace Laraveldesign\Comments\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function user() {
        return User::findOrFail($this->user_id);
    }
}
