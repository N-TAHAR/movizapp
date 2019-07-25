<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Egulias\EmailValidator\Warning\Comment;

class Like extends Model
{

    protected $guarded = [];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
