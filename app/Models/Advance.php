<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'amount', 'description'];

    protected $cast = [
        'description' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
