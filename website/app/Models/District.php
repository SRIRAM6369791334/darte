<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'state_id',
        'state_name',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
