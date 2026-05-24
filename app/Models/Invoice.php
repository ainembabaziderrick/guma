<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no', 'candidate_id', 'status', 'invoice_date', 
        'due_date', 'subtotal', 'tax', 'total', 'notes'
    ];

    protected $casts = [
        'invoice_date' => 'date:Y-m-d',
        'due_date' => 'date:Y-m-d',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($invoice) {
            $invoice->invoice_no = 'INV-' . str_pad(self::count() + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}