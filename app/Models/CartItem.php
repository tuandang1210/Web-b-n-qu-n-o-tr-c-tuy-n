<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    protected $fillable = [
        'cart_item_id',
        'cart_id',
        'product_id',
        'quantity',
        'size',
    ];

    public $timestamps = false;


}