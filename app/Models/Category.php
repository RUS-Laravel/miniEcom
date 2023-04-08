<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name', 'description', 'status', 'parent_id'
    ];

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('categories');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }
}
