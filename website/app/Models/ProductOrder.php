<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_door_no',
        'billing_street',
        'billing_area',
        'billing_city',
        'billing_state',
        'billing_pincode',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_door_no',
        'shipping_street',
        'shipping_area',
        'shipping_city',
        'shipping_state',
        'shipping_pincode',
        'subtotal',
        'gst_amount',
        'shipping_charge',
        'total_amount',
        'payment_status',
        'payment_method',
        'razorpay_order_id',
        'razorpay_payment_id',
        'status',
        'order_id',
        'delivery_person_name',
        'delivery_person_phone',
        'shiprocket_order_id',
        'shiprocket_shipment_id',
        'awb_code',
        'courier_name',
        'pickup_scheduled',
        'manifest_url',
        'label_url',
        'invoice_url',
        'shiprocket_status',
        'cancellation_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ProductOrderItem::class, 'order_id');
    }
}
