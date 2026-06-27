<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCategory extends Model
{
    use HasFactory;

    protected $table = 'gift_categories';

    protected $fillable = [
        'category_name',
        'category_image',
        'banner_title',
        'banner_description',
        'status',
    ];
}
