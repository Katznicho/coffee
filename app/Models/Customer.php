<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone_number', 'photo', 'nin'];

    public function balances()
    {
        return $this->hasMany(Balancing::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }

    
}
