<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name', 'price', 'category_id', 'description', 'stock', 'photo'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getPrice()
    {
       return 'R$ ' . number_format((float)$this->price, 2, ',', '.');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
