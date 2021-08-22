<?php

namespace App\Http\Controllers\Api\Biodata;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biodata\RequestBiodataImage;
use App\Http\Requests\Biodata\RequestBiodataUpdate;
use App\Services\Biodatas\BiodataService;
use App\Traits\Response\JsonHandler;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    use JsonHandler;

    private $service;

    public function __construct(BiodataService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        [$response, $status, $message] = $this->service->detail($request->user()->id);

        return $this->response($response, $status, $message);
    }

    public function image(RequestBiodataImage $request)
    {
        [$response, $status, $message] = $this->service->image($request->user(), $request->file("image"));

        return $this->response($response, $status, $message);
    }

    public function update(RequestBiodataUpdate $request)
    {
        [$response, $status, $message] = $this->service->update(
            $request->user(),
            $request->all()
        );

        return $this->response($response, $status, $message);
    }
}
