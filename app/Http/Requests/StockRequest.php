<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * StockRequest Class
 *
 * This class defines the validation rules and messages for stock-related requests.
 * It extends the FormRequest class provided by the Anik/Form package.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always returns true.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    protected function authorize(): bool
    {
        // This method determines if the user is authorized to make this request.
        // In this case, it always returns true, indicating that the request is authorized.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array Validation rules for stock requests.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    protected function rules(): array
    {
        // This method defines the validation rules for stock requests.
        // It returns an array where keys are field names and values are the validation rules.
        return [
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|numeric'
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array Custom validation messages for stock requests.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function messages(): array
    {
        // This method provides custom validation messages for specific validation rules.
        // It returns an array where keys are the validation rule names and values are the custom messages.
        return [
            'product_id.required' => 'Product Id is required',
            'product_id.exists' => 'Product Id not found',
            'stock.required' => 'Stock is required',
            'stock.numeric' => 'Stock must be a number'
        ];
    }
}
