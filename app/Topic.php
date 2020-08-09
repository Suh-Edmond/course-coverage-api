<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'outline_id',
        'name',
        'week_number',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
    public function outline()
    {
        return $this->belongsTo(Outline::class);
    }
}
