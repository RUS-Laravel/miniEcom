<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'title', 'description', 'slug', 'code', 'status', 'category_id', 'stock', 'price', 'discount', 'tags', 'product_recevied'
    ];

    protected $appends = ['total', 'total_formatted', 'diff'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    public function setSlugAttribute($value)
    {
        return $this->attributes['slug'] = str($value)->slug();
    }

    public function getEtagsAttribute()
    {
        return  explode(',', $this->tags);
    }

    // public function slug()
    // {
    //     return new Attribute(
    //         set: fn ($value) => str($value)->slug('-')->toString(),
    //         get: fn () => $this->slug,
    //     );
    // }

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

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function color_products(): HasOne
    {
        return $this->hasOne(Color_Products::class, 'product_id', 'id');
    }

    public function colors()
    {
        return $this->hasMany(Color_Products::class, 'product_id', 'id');
    }

    public function review_rating(): HasMany
    {
        return $this->hasMany(ReviewRating::class, 'product_id', 'id');
    }

    public function wish(): HasMany
    {
        return $this->hasMany(WishList::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }
}
