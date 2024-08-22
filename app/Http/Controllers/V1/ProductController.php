<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return new ProductCollection(Product::all());
        return new ProductCollection(Product::with('category')->get());
    }

   
    public function store(StoreProductRequest $request)
    {   
        Log::info('CONTROLLER: Incoming request data:', $request->all());

        $validatedData = $request->validated();
        
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['categoryId'],
            'image_url' => $validatedData['imageUrl']
        ]);

        return new ProductResource($product);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
       
       $validatedData = $request->validated();

       $updateData = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['categoryId'],
       ];

       if (isset($validatedData['imageUrl'])){
            $updateData['image_url'] = $validatedData['imageUrl'];
       }
       
       $product->update($updateData);
       return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
