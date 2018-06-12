<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['content'];

    protected $hidden = ['public', 'created_at'];


    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_questions')
            ->withPivot('correct_choice_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
