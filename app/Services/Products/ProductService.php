<?php
namespace App\Services\Products;

use App\Models\Product;
use App\Repositories\Products\ProductRepository;
use App\Traits\Files\FileUpload;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use FileUpload;

    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function first(string $slug)
    {
        $product = $this->repository->first($slug);

        if (is_null($product)) {
            return [null, 404, "Product not found"];
        }

        return [$product, 200, null];
    }

    public function update($user, $images, array $data = [])
    {
        DB::beginTransaction();
        try {
            $images_name = $this->uploadMultipleImages(public_path("images/products"), $images);

            $shop_id        = $user->shop->id;
            $product_id     = $data["id"];
            if (count($images_name) > 0) {
                $row_affected = $this->repository->update($product_id, $shop_id, $data);

                if ($row_affected > 0) {
                    $images_data = $this->createImagesData($images_name, $product_id);

                    $this->repository->deleteImages($product_id);
                    $images_inserted = $this->repository->insertImage($images_data);

                    DB::commit();

                    if ($images_inserted) {
                        return [null, 204, null];
                    }
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return [null, 500, "Something wrong, product update failed"];
    }

    public function insert($user, $images, array $data = []): array
    {
        DB::beginTransaction();
        try {
            // dont have validation yet
            $images_name = $this->uploadMultipleImages(public_path("images/products"), $images);

            if (count($images_name) > 0) {
                $product = $this->repository->insert(
                    $user->shop->id,
                    $data,
                );

                $images_data = $this->createImagesData($images_name, $product->id);

                $this->repository->insertImage($images_data);

                DB::commit();

                if ($product->wasRecentlyCreated) {
                    return [null, 201, null];
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return [null, 500, "Something wrong, product insert failed"];
    }

    private function createImagesData($images_name, $product_id)
    {
        return collect($images_name)->map(function ($item) use($product_id) {
            return [
                "product_id"    => $product_id,
                "image"         => $item,
                "created_at"    => now(),
                "updated_at"    => now(),
            ];
        })->toArray();
    }
}
