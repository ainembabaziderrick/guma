<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'full_name', 'email', 'phone', 'nationality', 
        'position_applied', 'status', 'date_applied', 'remarks'
    ];

    protected $casts = [
        'date_applied' => 'date:Y-m-d',
    ];
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
