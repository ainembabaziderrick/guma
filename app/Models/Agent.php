<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $table = 'agents';    
    protected $fillable = [
        'agent_name', 'contact_person', 'email', 'phone', 
        'country', 'city', 'address', 'status'
    ];
}
