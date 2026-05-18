<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtsRecovery extends Model
{
    use HasFactory;
    protected $table = 'debts_recovery';
    protected $fillable = [
        'debtor_id',
        'amount',
        
        'date',
        
            
        ];

        public function debtor()
{
    return $this->belongsTo(Debts::class, 'debtor_id');
}

}

