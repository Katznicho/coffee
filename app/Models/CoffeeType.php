<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

    public function balances()
    {
        return $this->hasMany(Balancing::class);
    }

    protected $casts = [
        'description' => 'array',
    ];
}
