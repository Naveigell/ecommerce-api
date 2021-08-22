<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed|string slug
 * @property mixed description
 * @property mixed price
 * @property mixed stock
 * @property mixed weight
 * @property mixed length
 * @property mixed width
 * @property mixed height
 * @property mixed shop_id
 */
class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // single
    public function image()
    {
        return $this->hasOne(ProductImage::class);
    }

    // multiple
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
