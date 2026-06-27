<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["category_name", "category_image", "category_banner", "category_icon", "is_gift", "banner_title", "banner_description"];

    /**
     * Get URL-safe slug from category_name.
     */
    public function getSlugAttribute(): string
    {
        return Str::slug($this->category_name);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
