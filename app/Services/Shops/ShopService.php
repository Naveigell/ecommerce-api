<?php


namespace App\Services\Shops;


use App\Repositories\Shops\ShopRepository;

class ShopService
{
    private $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function detail($slug)
    {
        $shop = $this->repository->detail($slug);
        if (is_null($shop)) {
            return [null, 404, "Shop not found"];
        }

        return [$shop, 200, null];
    }
}
