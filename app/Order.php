<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'customer_id',
        'player_id',
        'customer_coordinate',
        'track_mode_status ',
        'courier_number'
    ];
    public $timestamps = false;
}
