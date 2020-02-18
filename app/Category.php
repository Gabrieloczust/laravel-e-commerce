<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name', 'photo'
    ];

    public function product()
    {
        return $this->hasMany(Product::class) ?? [];
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = Str::ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}
