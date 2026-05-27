<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id',
        'full_name', 'email', 'phone', 'nationality', 'position_applied', 
        'status', 'date_applied', 'remarks', 
        'medical_status', 'medical_date', 'medical_notes',
        'police_status', 'police_date', 'police_notes',
        'visa_status', 'visa_date', 'visa_notes',
        'contract_status', 'contract_date', 'contract_file', 'contract_notes',
        'deployment_status', 'departure_date', 'arrival_date', 'flight_number', 'destination', 'deployment_notes',
        'post_deployment_status', 'probation_end_date', 'last_followup_date', 'post_deployment_notes',
        'region', 'district', 'county', 'subcounty', 'village', 'dob',
    ];

    protected $casts = [
        'date_applied' => 'date:Y-m-d',
        'medical_date' => 'date:Y-m-d',
        'police_date' => 'date:Y-m-d',
        'visa_date' => 'date:Y-m-d',
        'contract_date' => 'date:Y-m-d',
        'departure_date' => 'date:Y-m-d',
        'arrival_date' => 'date:Y-m-d',
        'probation_end_date' => 'date:Y-m-d',
        'last_followup_date' => 'date:Y-m-d',
    ];
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'paid')->sum('amount');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function commissions()
    {
        return $this->hasMany(AgentCommission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'candidate_id');
    }

}
