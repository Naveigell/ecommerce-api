<?php

namespace App\Http\Requests\Biodata;

use Illuminate\Foundation\Http\FormRequest;

class RequestBiodataUpdate extends FormRequest
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
            "gender"                => "required|string|in:Male,Female",
            "phone"                 => "required|regex:/(08)[0-9]{9}/",
            "address"               => "required|string|min:7|max:150",
        ];
    }
}
