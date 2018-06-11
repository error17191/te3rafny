<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
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

    public function scopeRandom($query)
    {
        return $query->inRandomOrder()->first();
    }

    public function scopeRandomForUser($query,$user)
    {
        return $query->inRandomOrder()->whereNotIn('id',$user->questions()->pluck('questions.id'))->first();
    }

}
