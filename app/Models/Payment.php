<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'candidate_id', 'type', 'status', 'amount',
        'payment_method', 'reference_no', 'payment_date', 'notes'
    ];

    protected $casts = [
        'payment_date' => 'date:Y-m-d',
        'amount' => 'decimal:2'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}