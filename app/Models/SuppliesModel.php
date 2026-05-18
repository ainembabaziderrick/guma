<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliesModel extends Model
{
    use HasFactory;

    protected $table = 'supplies';
    protected $fillable = [
        'supplier',
        'quantity',
        'total',
        'paid',
        'date',
        
            
        ];

}
