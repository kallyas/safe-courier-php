<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'owner_id', 'status', 'recepient_email'
    ];
}
