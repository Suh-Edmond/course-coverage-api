<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    //topic relationship
    public function topics()
    {
        return $this->belongsToMany(Topics::class);
    }
    //coverage relationship
    public function coverages()
    {
        return $this->hasMany(Coverage::class);
    }
}
