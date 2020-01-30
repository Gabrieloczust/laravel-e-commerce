<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'total'
    ];
}
