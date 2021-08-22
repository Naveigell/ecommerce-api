<?php


namespace App\Interfaces\Products;


interface IProduct
{
    public function first(string $slug);
    public function insert($shop_id, array $data = []);
    public function insertImage(array $data = []);
    public function update($product_id, $shop_id, array $data);
}
