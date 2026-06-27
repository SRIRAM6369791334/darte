<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    use App\Models\ProductChildImage;


class ProductVarient extends Model {
    use HasFactory;

    protected $table = 'product_varient';

    protected $fillable = [ 'categoryid', 'subcategoryid', 'product_id', 'sku', 'barcode', 'unit_id', 'varient', 'value', 'offer_price', 'mrp_price', 'product_qty', 'product_gst','low_stock', 'hot_deals', 'Popular_products', 'pre_order', 'pre_note','product_gst', 'subcatename', 'varient_img', 'varient_name', 'size_value', 'flash_sale', 'flash_sale_date', 'weight', 'length', 'breadth', 'height' ];

    public function product() {
        return $this->belongsTo( Product::class );
    }

    public function category() {
        return $this->belongsTo( Category::class );
    }

    public function unit() {
        return $this->belongsTo( Unit::class );
    }



public function images()
{
    return $this->hasMany(ProductChildImage::class, 'variant_id');
}
}
