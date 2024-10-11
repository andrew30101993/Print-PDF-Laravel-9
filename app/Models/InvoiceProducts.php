<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProducts extends Model
{
    use HasFactory;

    // Relationship to fetch product data
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id'); // ensure 'product_id' is correct
    }
}
