<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
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
            'authorFirstname' => 'required|string|max:255',
            'authorSurname' => 'required|string|max:255',
            'company' => 'required|string',
            'position' => 'required|string',
            'content' => 'required|string',
            'rating' => 'required|integer|min:0|max:255',
            'imageUrl' => 'required|string', 
        ];
    }

    public function prepareForValidation(){

        $this->merge([
            'image_url' => $this->imageUrl,
            'author_firstname' => $this->authorFirstname,
            'author_surname' => $this->authorSurname,
        ]);
    }
}
