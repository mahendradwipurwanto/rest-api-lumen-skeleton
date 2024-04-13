<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

/**
 * ProductRequest Class
 *
 * This class defines the validation rules and messages for product-related requests.
 * It extends the FormRequest class provided by the Anik/Form package.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class ProductRequest extends FormRequest
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
     * @return array Validation rules for product requests.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    protected function rules(): array
    {
        // This method defines the validation rules for product requests.
        // It returns an array where keys are field names and values are the validation rules.
        return [
            'name' => 'required|string|unique:products',
            'description' => 'string',
            'price' => 'required|numeric',
            'stock' => 'numeric'
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array Custom validation messages for product requests.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public function messages(): array
    {
        // This method provides custom validation messages for specific validation rules.
        // It returns an array where keys are the validation rule names and values are the custom messages.
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Name is already taken',
            'description.required' => 'Description is required',
        ];
    }
}
