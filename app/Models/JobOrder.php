<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;
    protected $table = 'job_orders';
    protected $fillable = [
        'order_number', 'employer_id', 'agent_id', 'job_title', 
        'vacancies', 'location', 'salary', 'status', 'deadline', 'description'
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary' => 'decimal:2'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
