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

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
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
