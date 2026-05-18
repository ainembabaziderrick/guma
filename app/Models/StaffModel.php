<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = [
        'name',
        'email',
        'number',
        'address',
        'nin',
        'nok',
        'nok_contact',
        'nok_nin',
        
        ];
}
