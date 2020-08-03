<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outline extends Model
{
    protected $guarded = [];
    //course relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // topic relationship
    public function topics()
    {
        return $this->hasMany(Topics::class);
    }
}
