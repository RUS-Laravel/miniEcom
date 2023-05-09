<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;
    protected $table = "size";
    protected $fillable = [
        'size_name', 'size'
    ];

   

    public function product_size(): HasMany
    {
        return $this->hasMany(Product_Size::class, 'size_id', 'id');
    }
}
