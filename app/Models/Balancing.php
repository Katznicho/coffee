<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balancing extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'coffee_type_id', 'amount', 'milling', 'bag', 'box', 'labour', 'sun_dry', 'transport', 'advance', 'balance'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
