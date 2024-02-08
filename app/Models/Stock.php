<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['coffee_type_id', 'total_kgs', 'price'];

    public function coffeeType()
    {
        return $this->belongsTo(CoffeeType::class);
    }
}
