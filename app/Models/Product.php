<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'title', 'description', 'slug', 'code', 'status', 'category_id', 'stock', 'price', 'discount'
    ];

    protected $appends = ['total', 'total_formatted', 'diff'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    // public function setSlugAttribute($value)
    // {
    //     return $this->attributes['slug'] = str($value)->slug();
    // }

    public function slug()
    {
        return new Attribute(
            set: fn ($value) => str($value)->slug('-')->toString()
        );
    }

    public function getTotalAttribute(): float
    {
        return  $this->stock * $this->price;
    }

    public function getDiffAttribute()
    {
        return now()->diffForHumans($this->updated_at);
    }

    public function getTotalFormattedAttribute(): string
    {
        return  number_format($this->stock * $this->price, 2) . " AZN";
    }

    public function getPricePrettyAttribute(): string
    {
        return  number_format($this->price, 2) . " AZN";
    }

    public function getDiscountPriceAttribute(): string
    {
        return  number_format($this->price - ($this->price * $this->discount / 100), 2) . " AZN";
    }

    // public function total(): Attribute
    // {
    //     return new Attribute(
    //         get: fn () => $this->stock * $this->price
    //     );
    // }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
