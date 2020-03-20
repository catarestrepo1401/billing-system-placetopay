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

    /**
     * Scope a query to only include items of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        if ($type != '') {
            return $query->where('type', $type);
        }
    }

    /**
     * Scope a query to only include items of a given code.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCode($query, $code)
    {
        if ($code != '') {
            return $query->where('code', 'LIKE', "%$code%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfName($query, $name)
    {
        if ($name != '') {
            return $query->where('name', 'LIKE', "%$name%");
        }
    }
}
