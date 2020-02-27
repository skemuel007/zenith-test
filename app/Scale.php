<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    //
    protected $fillable = [
        'monthly',
        'rate'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
