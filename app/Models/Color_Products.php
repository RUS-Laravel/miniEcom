<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color_Products extends Model
{
    use HasFactory;
    protected $table = "color_products";
    protected $fillable = [
        'color_id','product_id'
    ];
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function color(): HasMany
    {
        return $this->hasMany(Color::class, 'id', 'color_id');
    }
}
