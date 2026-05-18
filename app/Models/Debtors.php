<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtors extends Model
{
    use HasFactory;

    protected $table = 'debtors';
    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        
            
        ];

        public function recoveries()
        {
            return $this->hasMany(DebtorsRecovery::class, 'debtor_id');
        }
}
