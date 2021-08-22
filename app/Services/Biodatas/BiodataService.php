<?php


namespace App\Services\Biodatas;


use App\Repositories\Biodatas\BiodataRepository;
use App\Traits\Files\FileUpload;

class BiodataService
{
    use FileUpload;

    private $repository;

    public function __construct(BiodataRepository $repository)
    {
        $this->repository = $repository;
    }

    public function detail($id)
    {
        $biodata = $this->repository->detail($id);

        if (is_null($biodata)) {
            return [null, 404, "Biodata not found"];
        }

        return [$biodata, 200, null];
    }

    public function image($user, $file)
    {
        $images = $this->uploadMultipleImages(public_path("images/users"), [$file]);
        if (count($images) > 0) {
            $row_affected = $this->repository->image($user->id, $images[0]);

            if ($row_affected > 0) {
                return [null, 204, null];
            }
        }

        return [null, 500, "Something wrong, biodata image update failed"];
    }

    public function update($user, array $data = [])
    {
        $updated = $this->repository->update($user->id, $data);
        if ($updated) {
            return [null, 204, null];
        }

        return [null, 500, "Something wrong, biodata update failed"];
    }
}
