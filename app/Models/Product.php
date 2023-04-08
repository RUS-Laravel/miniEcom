<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'title', 'description', 'slug', 'code', 'status', 'category_id', 'stock', 'price', 'discount'
    ];

    // public function setSlugAttribute($value)
    // {
    //     return $this->attributes['slug'] = str($value)->slug();
    // }

    public function slug()
    {
        return new Attribute(
            set: fn ($value) => str($value)->slug('-')
        );
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
