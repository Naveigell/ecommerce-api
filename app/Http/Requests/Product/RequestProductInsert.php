<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class RequestProductInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"          => "required|string|min:6|max:100",
            "description"   => "required|string|min:15|max:1000",
            // between 1.000 and 200.000.000
            "price"         => "required|numeric|between:1000,200000000",
            "stock"         => "required|integer|min:1|max:9999",
            "weight"        => "sometimes|integer|min:0|max:999",
            "width"         => "sometimes|integer|min:0|max:999",
            "length"        => "sometimes|integer|min:0|max:999",
            "height"        => "sometimes|integer|min:0|max:999",
            "images"        => "required|array",
            "images.*"      => "required|mimes:jpg,png,jpeg|max:10000"
        ];
    }
}
