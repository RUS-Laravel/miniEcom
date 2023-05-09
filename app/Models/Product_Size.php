<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product_Size extends Model
{
    use HasFactory;
    protected $table = "product_size";
    protected $fillable = [
        'size_id','product_color_id'
    ];

    public function size(): HasOne
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    
   
}
