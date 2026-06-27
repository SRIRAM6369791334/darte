<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
//     protected $fillable = [
//     'user_id',
//     'name',
//     'email',
//     'phone_number',
//     'password',
//     'enc_password',
//     'is_guest_user'
// ];
protected $fillable = [
    'user_id',
    'name',
    'email',
    'phone_number',
    'password',
    'is_guest_user',
    'first_name',
    'last_name',
    'gender',
    'profile_image',
    'billing_name',
    'billing_phone',
    'billing_door_no',
    'billing_street',
    'billing_area',
    'billing_city',
    'billing_state',
    'billing_pincode',
    'shipping_name',
    'shipping_phone',
    'shipping_door_no',
    'shipping_street',
    'shipping_area',
    'shipping_city',
    'shipping_state',
    'shipping_pincode',
    'door_no',
    'street',
    'area',
    'city',
    'state',
    'pincode',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
