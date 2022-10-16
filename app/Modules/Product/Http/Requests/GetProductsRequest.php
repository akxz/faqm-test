<?php

namespace App\Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProductsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => 'sometimes',
            'material' => 'sometimes',
            'meal_type' => 'sometimes',
            'weight_from' => 'sometimes|numeric',
            'weight_to' => 'sometimes|numeric',
            'length_from' => 'sometimes|numeric',
            'length_to' => 'sometimes|numeric',
            'width_from' => 'sometimes|numeric',
            'width_to' => 'sometimes|numeric',
            'height_from' => 'sometimes|numeric',
            'height_to' => 'sometimes|numeric',
        ];
    }
}
