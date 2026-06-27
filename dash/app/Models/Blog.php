<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
        'title',
        'url_name',
        'description',
        'image',
        'date',
        'meta_title',
        'meta_description',
        'meta_key',
    ];
}
