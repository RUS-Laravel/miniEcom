<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserInformation extends Model
{
    use HasFactory;
    protected $table = "address";
    protected $fillable = [
        'user_id', 'phone', 'address'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'address_id', 'id');
    }
}
