<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(related: User::class);
    }

    // Relationship to fetch associated invoice products
    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProducts::class, 'invoice_id'); // ensure 'invoice_id' is correct
    }
}
