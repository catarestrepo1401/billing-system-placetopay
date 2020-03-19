<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'type',
        'name',
        'price'
    ];

    /**
     * The invoices that belong to the item.
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
