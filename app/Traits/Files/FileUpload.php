<?php
namespace App\Traits\Files;


use Illuminate\Support\Str;

trait FileUpload
{
    public function uploadMultipleImages(string $destination, array $images, array $accept = ["jpg", "png", "jpeg"]) : array
    {
        $images_name = [];

        foreach ($images as $image) {
            $filename       = Str::uuid()."-".strtolower(uniqid());
            $extension      = $image->getClientOriginalExtension();

            // simple backdoor protection
            if (in_array($extension, $accept)) {
                $fullFileName   = $filename.".".$extension;

                // move and store a new image name into $list variable
                if ($image->move($destination, $fullFileName)) {
                    array_push($images_name, $fullFileName);
                }
            }
        }

        return $images_name;
    }

    public function uploadMultipleFiles()
    {

    }
}
