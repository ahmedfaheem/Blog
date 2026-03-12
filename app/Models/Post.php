<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Comment;
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "title",
        "description",
        "author_id"
    ];



    public function User(){
        return $this->belongsTo(User::class, "author_id");
    }
   
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
