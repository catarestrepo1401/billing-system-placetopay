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
        'delivery_at',
        'discount_rate',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expired_at',
        'delivery_at',
    ];

    /**
     * Get the payments for the invoice.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

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

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $document_number
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDocumentNumber($query, $document_number)
    {
        if ($document_number != '') {
            return $query->where('document_number', 'LIKE', "%$document_number%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $document_type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDocumentType($query, $document_type)
    {
        if ($document_type != '') {
            return $query->where('document_type', $document_type);
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $expired_at
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfExpiredDate($query, $expired_at)
    {
        if ($expired_at != '') {
            return $query->whereDate('expired_at', $expired_at);
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $delivery_at
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDeliveryDate($query, $delivery_at)
    {
        if ($delivery_at != '') {
            return $query->whereDate('delivery_at', $delivery_at);
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $total
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTotal($query, $total)
    {
        if ($total != '') {
            return $query->where('total', 'LIKE', "%$total%");
        }
    }

    public function getCustomerOptions()
    {
        return User::oldest('full_name')
            ->pluck('full_name', 'id')
            ->toArray();
    }
}
