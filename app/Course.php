<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'course_code',
        'title',
        'credit_value',
        'type',
        'semester',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
    //course schedule relationship
    public function courseSchedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    //course_delegate relationship
    public function course_delegates()
    {
        return $this->belongsToMany(CourseDelegate::class);
    }
    //lecturer relationship
    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }
    //outline relationship
    public function outlines()
    {
        return $this->hasMany(Outline::class);
    }


    //coverage relationship
    public  function coverages()
    {
        return $this->hasMany(Coverage::class);
    }
}
