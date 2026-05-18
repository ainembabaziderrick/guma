<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselModel extends Model
{
    use HasFactory;
    protected $table = 'carousel';

    protected $fillable = [
        'type',
        'description',        
                
        'image',        
    ];
}
