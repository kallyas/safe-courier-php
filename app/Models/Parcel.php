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
    protected $table = 'parcels';

    protected $fillable = [
        'user_id',
        'status',
        'recepient_email',
        'description',
        'notes',
        'from_location',
        'to_location',
        'weight',
        'price',
        'recipient_name',
        'recipient_email',
        'recipient_phone',
        'recipient_address',
        'present_location',
        'pickup_location',
        'drop_off_location',
        'tracking_number'
    ];
}
