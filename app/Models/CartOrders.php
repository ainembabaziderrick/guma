<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOrders extends Model
{
    use HasFactory;

    protected $table = 'cartorders';

    protected $fillable = [
        'name',
        'contact',
        'email',
        'quantity',
        'location',
        'product_id',
        'total_price',
        'user_id'
    ];

    /**
     * Each cart item belongs to a product
     */
    public function product()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id', 'id');
    }

    /**
     * Each cart item belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
