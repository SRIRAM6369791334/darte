<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceContact extends Model
{
    protected $table = 'insurancecontact';

    protected $fillable = [
        'name',
        'email',
        'number',
        'message',
    ];
}
