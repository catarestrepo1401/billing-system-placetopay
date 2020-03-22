<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identification',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the invoices for the user.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the payments for the user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $identification
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfIdentification($query, $identification)
    {
        if ($identification != '') {
            return $query->where('identification', 'LIKE', "%$identification%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $first_name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfFistName($query, $first_name)
    {
        if ($first_name != '') {
            return $query->where('first_name', 'LIKE', "%$first_name%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $last_name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLastName($query, $last_name)
    {
        if ($last_name != '') {
            return $query->where('last_name', 'LIKE', "%$last_name%");
        }
    }

    /**
     * Scope a query to only include items of a given name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $email
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfEmail($query, $email)
    {
        if ($email != '') {
            return $query->where('email', 'LIKE', "%$email%");
        }
    }

}
