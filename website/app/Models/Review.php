<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'prod_id',
        'prod_var_id',
        'review',
        'ratings',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVarient::class, 'prod_var_id');
    }
}
