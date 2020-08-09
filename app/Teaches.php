<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaches extends Model
{
    protected $fillable = [
        'course_id',
        'lecturer_id',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
}
