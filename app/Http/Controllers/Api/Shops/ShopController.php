<?php

namespace App\Http\Controllers\Api\Shops;

use App\Http\Controllers\Controller;
use App\Services\Shops\ShopService;
use App\Traits\Response\JsonHandler;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use JsonHandler;

    private $service;

    public function __construct(ShopService $service)
    {
        $this->service = $service;
    }

    public function detail($slug)
    {
        [$response, $status, $message] = $this->service->detail($slug);

        return $this->response($response, $status, $message);
    }

    public function update()
    {

    }

    public function image()
    {

    }
}
