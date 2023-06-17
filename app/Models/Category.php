<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name', 'description', 'status', 'parent_id','tags'
    ];

    public function getEtagsAttribute()
    {
        return  explode(',', $this->tags);
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('categories');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function scopeActiveproduct($query)
    {
        return $query->where('status', 1);
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
