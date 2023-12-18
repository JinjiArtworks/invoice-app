<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'unit_price',
        'quantity',
    ];
    use HasFactory;

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function product()
    {
        // belongs to karna di table invoice item ada product id
        return $this->belongsTo(Products::class);
    }
}
