<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'categoryId' => 'required|exists:categories,id',
            'imageUrl' => 'required|string|max:255',
        ];
    }
    

    public function prepareForValidation() {

        
        $this->merge([
            'image_url' => $this->imageUrl,
            'category_id' => $this->categoryId,
        ]);

        Log::info('Data after prepareForValidation:', $this->all());
    }
}
