<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cost',
    ];

    public $timestamps = false;

    public function orders()
    {
        $this->hasMany(OrdersProducts::class);
    }
}
