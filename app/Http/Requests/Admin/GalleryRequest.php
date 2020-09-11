<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $travel = 'integer|exists:travel_packages,id';
        } else {
            $travel = 'required|integer|exists:travel_packages,id';
        }
        
        return [
            'travel_packages_id' => $travel,
            'image' => 'required|image'
        ];
    }
}
