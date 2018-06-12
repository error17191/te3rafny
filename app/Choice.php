<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }

}
