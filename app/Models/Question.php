<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable=["user_id","title","details"];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function answer(){
        return $this->hasMany(Answer::class);
    }
    public function topic(){
        return $this->belongsToMany(Topic::class);
    }
}
