<?php
namespace App\Repositories\Products;


use App\Interfaces\Products\IProduct;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductRepository implements IProduct
{
    public function insert($shop_id, array $data = []): Product
    {
        $product = new Product();
        $product->shop_id       = $shop_id;
        $product->name          = $data["name"];
        $product->slug          = Str::slug($data["name"]."-".uniqid());
        $product->description   = $data["description"];
        $product->price         = $data["price"];
        $product->stock         = $data["stock"];
        $product->weight        = request()->get("weight", 0);
        $product->length        = request()->get("length", 0);
        $product->width         = request()->get("width", 0);
        $product->height        = request()->get("height", 0);
        $product->save();

        return $product;
    }

    public function insertImage(array $data = [])
    {
        return ProductImage::query()->insert($data);
    }

    public function deleteImages($product_id)
    {
        return ProductImage::query()->where("product_id", $product_id)->delete();
    }

    public function update($product_id, $shop_id, array $data)
    {
        return Product::query()->where([
            "id"            => $product_id,
            "shop_id"       => $shop_id,
        ])->update([
            "name"          => $data["name"],
            "description"   => $data["description"],
            "price"         => $data["price"],
            "stock"         => $data["stock"],
            "weight"        => request()->get("weight", 0),
            "length"        => request()->get("length", 0),
            "width"         => request()->get("width", 0),
            "height"        => request()->get("height", 0),
        ]);
    }

    public function first(string $slug)
    {
        return Product::query()->with([
            'images:product_id,image',
            'shop:id,account_id,name,slug,description,city,address,shop_avatar'
        ])->where('slug', $slug)->first();
    }
}
