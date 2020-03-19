<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The invoices that belong to the item.
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
