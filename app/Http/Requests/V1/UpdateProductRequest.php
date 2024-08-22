<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'categoryId' => 'required|exists:categories,id',
            'imageUrl' => 'sometimes|string|max:255',
        ];
    }
    
    public function prepareForValidation() {

        $this->merge([
            'category_id' => $this->categoryId,
            'image_url' => $this->imageUrl,
        ]);
    }
}
