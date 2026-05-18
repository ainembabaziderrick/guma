<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debts extends Model
{
    use HasFactory;

    protected $table = 'debts';
    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        
            
        ];

        public function recoveries()
{
    return $this->hasMany(DebtsRecovery::class, 'debtor_id');
}

}
