<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seotag extends Model
{
    use HasFactory;

    protected $table = 'seotags';

    protected $fillable = [
        'url',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'schema_code',
    ];
}
