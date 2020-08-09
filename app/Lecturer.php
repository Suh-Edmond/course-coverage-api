<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = ['user_name', 'matricule_number', 'email', 'telephone', 'password','created_at', 'updated_at'];
    public $timestamps = true;
    protected $hidden = [
        'password', 'rememberToken',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
