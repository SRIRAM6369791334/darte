<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table    = 'newsletter_subscribers';
    protected $fillable = ['email', 'is_active', 'subscribed_at'];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'is_active'     => 'boolean',
    ];
}
