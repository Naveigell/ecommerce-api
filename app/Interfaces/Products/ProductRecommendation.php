<?php


namespace App\Interfaces\Products;


interface ProductRecommendation
{
    public function recommendation($user, $take = 10);
}
