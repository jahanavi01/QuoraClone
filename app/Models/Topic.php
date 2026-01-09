<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable=['name','description'];
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

}
