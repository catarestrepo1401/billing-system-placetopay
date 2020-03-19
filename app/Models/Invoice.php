<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    /**
     * Get the user that owns the invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer that owns the invoice.
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The items that belong to the invoice.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->using(InvoiceItem::class)
            ->withPivot([
                'description',
                'quantity',
                'unit_price',
                'total',
            ]);
    }
}
