<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier',
        'method',
        'amount',
    ];

    /**
     * Get the invoice that owns the payment.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the customer that owns the payment.
     */
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        if ($status != '') {
            return $query->where('status', 'LIKE', "%$status%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $identifier
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfIdentifier($query, $identifier)
    {
        if ($identifier != '') {
            return $query->where('identifier', 'LIKE', "%$identifier%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $method
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMethod($query, $method)
    {
        if ($method != '') {
            return $query->where('method', 'LIKE', "%$method%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $amount
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfAmount($query, $amount)
    {
        if ($amount != '') {
            return $query->where('amount', 'LIKE', "%$amount%");
        }
    }

    public function getMethodOptions()
    {
        return [
            'debit_card' => __('Debit card'),
            'credit_card' => __('Credit card'),
            'cash' => __('Cash'),
            'bank_payment' => __('Bank payment'),
            'bank_check' => __('Bank check'),
            'electronic_transfer' => __('Electronic transfer')
        ];
    }
}
