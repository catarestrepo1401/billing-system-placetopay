<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_number',
        'document_type',
        'expired_at',
        'delivery_at',
        'subtotal',
        'discount_rate',
        'discount',
        'net',
        'tax_rate',
        'tax',
        'total'
    ];

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
