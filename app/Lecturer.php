<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'password', 'rememberToken',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
