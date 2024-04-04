<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product Id is required',
            'product_id.exists' => 'Product Id not found',
            'stock.required' => 'Stock is required',
            'stock.numeric' => 'Stock must be a number'
        ];
    }
}
