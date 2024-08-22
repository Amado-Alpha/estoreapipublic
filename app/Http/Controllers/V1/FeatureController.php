<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\Feature;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FeatureResource;
use App\Http\Resources\V1\FeatureCollection;
use App\Http\Requests\V1\UpdateFeatureRequest;
use App\Http\Requests\V1\StoreFeatureRequest;


class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FeatureCollection(Feature::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Checking feature uniqueness
    public function checkUnique($description)
    {
        \Log::info('Checking uniqueness for description: ' . $description);
        $exists = Feature::where('description', $description)->exists();
        \Log::info('Exists: ' . $exists);
        return response()->json(['exists' => $exists]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        $validatedData = $request->validated();
        $feature = Feature::create([
            'description' => $validatedData['description']
        ]);
        return new FeatureResource($feature);
        // return new FeatureResource(Feature::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return new FeatureResource($feature);
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
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        
        $feature->update($request->all());
        return new FeatureResource($feature);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json(null, 204);
    }
}
