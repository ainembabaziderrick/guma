<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'contact',
        'email',
        'location',
        'product_id',
        'quantity',
        'total_price',
        'user_id',
    ];

    /**
     * Relationship: Each order belongs to one product
     */
    public function product()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id', 'id');
    }

    /**
     * Relationship: Each order belongs to one user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
