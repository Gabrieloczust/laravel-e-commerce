<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'product_name',
        'product_price',
        'product_amount',
        'sale_id',
    ];

    public static function cartTotal($cart)
    {
        return array_reduce($cart, function ($price, $produto) {
            $price += $produto->product_total;
            return $price;
        });
    }

    public static function cartCount($cart)
    {
        return array_reduce($cart, function ($amount, $produto) {
            $amount += $produto->product_amount;
            return $amount;
        });
    }
}
