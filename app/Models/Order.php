<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'telephone',
        'email',
        'address',
        'price',
        'date_order'
    ];

    protected $casts = [
        'date_order' => 'datetime:d-m-Y'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }



}
