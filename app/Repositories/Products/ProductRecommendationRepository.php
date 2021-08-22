<?php
namespace App\Repositories\Products;

use App\Interfaces\Products\ProductRecommendation;
use App\Models\Product;

class ProductRecommendationRepository implements ProductRecommendation
{
    public function recommendation($user, $take = 10)
    {
        $shop_id = is_null($user) ? $user : $user->shop->id;
        $query = Product::query()->select([
            'id', 'name AS product_name', 'slug', 'description', 'price', 'stock', 'shop_id'
        ])->with([
            "image:image,product_id",
            "shop:id,name,city"
        ]);

        if (!is_null($shop_id)) {
            $query->whereNotIn("shop_id", [$shop_id]);
        }

        return $query->limit($take)->get();
    }
}
