<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = null;
    protected $fillable = ['choice_id', 'answered_by_id', 'asked_by_id', 'question_id'];
}
