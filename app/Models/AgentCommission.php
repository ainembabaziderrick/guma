<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $fillable = [
        'agent_id', 'candidate_id', 'invoice_id', 'status',
        'commission_rate', 'base_amount', 'commission_amount',
        'earned_date', 'paid_date', 'notes'
    ];

    protected $casts = [
        'earned_date' => 'date:Y-m-d',
        'paid_date' => 'date:Y-m-d',
        'commission_rate' => 'decimal:2',
        'base_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2'
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}