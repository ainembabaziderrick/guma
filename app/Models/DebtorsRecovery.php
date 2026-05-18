<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtorsRecovery extends Model
{
    use HasFactory;
    protected $table = 'debtors_recovery';
    protected $fillable = [
        'debtor_id',
        'amount',
        
        'date',
        
            
        ];

        public function debtor()
{
    return $this->belongsTo(Debtors::class, 'debtor_id');
}
}
