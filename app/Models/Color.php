<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;
    protected $table = "colors";
    protected $fillable = [
        'color_name'
    ];

    public function color_products(): HasOne
    {
        return $this->hasOne(Color_Products::class, 'color_id', 'id');
    }
}
