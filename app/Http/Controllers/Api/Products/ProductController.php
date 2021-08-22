<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\RequestProductInsert;
use App\Http\Requests\Product\RequestProductUpdate;
use App\Services\Products\ProductRecommendationService;
use App\Services\Products\ProductService;
use App\Traits\Response\JsonHandler;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use JsonHandler;

    private $recommendation;
    private $service;

    public function __construct(
        ProductRecommendationService $recommendation,
        ProductService $service
    )
    {
        $this->recommendation = $recommendation;
        $this->service = $service;
    }

    public function index(Request $request, $take): \Illuminate\Http\JsonResponse
    {
        [$response, $status] = $this->recommendation->getRecommendation($request->user(), $take);

        return json($response, $status);
    }

    public function detail($slug)
    {
        [$response, $status, $message] = $this->service->first($slug);

        return $this->response($response, $status, $message);
    }

    public function update(RequestProductUpdate $request)
    {
        [$response, $status, $message] = $this->service->update(
            $request->user(),
            $request->file("images"),
            $request->all()
        );

        return $this->response($response, $status, $message);
    }

    public function insert(RequestProductInsert $request)
    {
        [$response, $status, $message] = $this->service->insert(
            $request->user(),
            $request->file("images"),
            $request->all()
        );

        if ($status >= 400) {
            return error([
                "message"       => $message
            ], $status);
        }

        return $this->response($response, $status, $message);
    }
}
