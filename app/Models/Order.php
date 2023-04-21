<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'no', 'status', 'payment_status', 'payment_type', 'discount', 'tax', 'shipment', 'user_id', 'adress_id'
    ];

    public function setNoAttribute()
    {
        $this->attributes['no'] = uniqid();
    }

    public function setStatusAttribute()
    {
        $this->attributes['status'] = 'Processing';
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}