<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasActivity extends Model
{
    protected $fillable = [
        'topic_id',
        'activity_id',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
}
