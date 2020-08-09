<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outline extends Model
{
    protected $fillable = [
        'course_id',
        'year',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
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
