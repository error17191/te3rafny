<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'user_questions')
            ->withPivot('correct_choice_id');
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function addQuestion($question, $choice)
    {
        return $this->questions()->attach($question, [
            'correct_choice_id' => $choice->id
        ]);

    }

    public function isCorrectChoice($question, $choice)
    {
        return $this->getCorrectChoiceId($question) == $choice->id;
    }

    public function getCorrectChoiceId($question)
    {
        return ($question = $this->questions()->where('question_id', $question->id)
            ->first()) ? $question->pivot->correct_choice_id : null;
    }

    public function getCorrectChoice($question)
    {
        return Choice::find($this->getCorrectChoiceId($question));
    }

}
