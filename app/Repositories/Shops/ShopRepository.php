<?php
namespace App\Repositories\Shops;


use App\Interfaces\Shops\IShop;
use App\Models\Shop;

class ShopRepository implements IShop
{
    public function detail($slug)
    {
        return Shop::query()->where("slug", $slug)->first();
    }
}
