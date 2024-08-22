<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'authorFirstname' => $this->author_firstname,
            'authorSurname' => $this->author_surname,
            'company' => $this->company,
            'position' => $this->position,
            'content' => $this->content,
            'rating' => $this->rating,
            'imageUrl' => $this->image_url,
        ];
    }
}
