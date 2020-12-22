<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coverage extends Model
{
    protected $fillable = ['week_number', 'period', 'day', 'user_id','year', 'course_id', 'topic_id','activity_id','created_at', 'updated_at'];
    
}
