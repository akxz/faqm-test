<?php

namespace App\Modules\OrderProduct\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderProductRequest extends FormRequest
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
            'user_id' => 'required|numeric|min:1',
            'product_id' => 'required|numeric|exists:products,id',
            'count_items' => 'required|numeric|min:1',
        ];
    }
}
