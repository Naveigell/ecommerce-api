<?php
namespace App\Services\Products;


use App\Repositories\Products\ProductRecommendationRepository;

class ProductRecommendationService
{
    private $repository;

    public function __construct(ProductRecommendationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRecommendation($user, $take = 10): array
    {
        return [
            $this->repository->recommendation($user, $take), 200
        ];
    }
}
