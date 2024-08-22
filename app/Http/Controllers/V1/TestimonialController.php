<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Testimonial;
use App\Http\Resources\V1\TestimonialResource;
use App\Http\Resources\V1\TestimonialCollection;
use App\Http\Requests\V1\StoreTestimonialRequest;
use App\Http\Requests\V1\UpdateTestimonialRequest;
use Illuminate\Support\Facades\Log; 


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TestimonialCollection(Testimonial::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {

        $validatedData = $request->validated();

        $testimonial = Testimonial::create([
            'author_firstname' => $validatedData['authorFirstname'],
            'author_surname' => $validatedData['authorSurname'],
            'content' => $validatedData['content'],
            'company' => $validatedData['company'],
            'position' => $validatedData['position'],
            'rating' => $validatedData['rating'],
            'image_url' => $validatedData['imageUrl']
        ]);

        return new TestimonialResource($testimonial);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return new TestimonialResource($testimonial);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $validatedData = $request->validated();
        
        $updateDate = [
            'author_firstname' => $validatedData['authorFirstname'],
            'author_surname' => $validatedData['authorSurname'],
            'content' => $validatedData['content'],
            'company' => $validatedData['company'],
            'position' => $validatedData['position'],
            'rating' => $validatedData['rating'],
        ];

        if (isset($validatedData['imageUrl'])){
            $updateDate['image_url'] = $validatedData['imageUrl'];
        }

        $testimonial->update($updateDate);

        return new TestimonialResource($testimonial);
        // $testimonial->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(null, 204);
    }

}
