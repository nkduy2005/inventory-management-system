<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "skud", "quantity"];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
