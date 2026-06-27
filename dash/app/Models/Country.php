<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';

    // If you want to allow mass assignment for these fields
    protected $fillable = ['name', 'iso_code', 'phone_code', 'ship_charge'];

    // If your table does not have timestamps (created_at, updated_at)
    // public $timestamps = false;
}
