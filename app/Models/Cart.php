<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'cart_id',
        'user_id'
    ];

    const UPDATED_AT = null;
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
