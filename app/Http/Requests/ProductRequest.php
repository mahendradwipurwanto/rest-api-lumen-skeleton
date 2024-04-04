<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products',
            'description' => 'string',
            'price' => 'required|numeric',
            'stock' => 'numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Name is already taken',
            'description.required' => 'Description is required',
        ];
    }
}
