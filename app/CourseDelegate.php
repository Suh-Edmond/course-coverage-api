<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseDelegate extends Model
{
    protected $fillable = ['access_id', 'user_name', 'matricule_number', 'email', 'telephone', 'password','created_at', 'updated_at'];
    public $timestamps = true;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
