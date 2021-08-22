<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed image
 */
class ProductImage extends Model
{
    use HasFactory;

    protected $appends = ["image_url"];

    public function getImageUrlAttribute(): string
    {
        return url('/').'/images/products/'.$this->image;
    }
}
