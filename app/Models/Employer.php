<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{

    protected $table = 'employers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_name', 'contact_person', 'email', 'phone', 
        'country', 'city', 'address', 'status'
    ];

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }
}