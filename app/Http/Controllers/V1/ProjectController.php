<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProjectResource;
use App\Http\Resources\V1\ProjectCollection;
use App\Http\Requests\V1\StoreProjectRequest;
use App\Http\Requests\V1\UpdateProjectRequest;
use Illuminate\Support\Facades\Log; 

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProjectCollection(Project::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // Log::info('CONTROLLER: Incoming request data:', $request->all());

        $validatedData = $request->validated();

        // Log::info('CONTROLLER: Validated data:', $validatedData);

        $project = Project::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image_url' => $validatedData['imageUrl']
        ]);

        Log::info('CONTROLLER: Validated data:', $validatedData);

        // Attach features to the project
        if (isset($validatedData['features']) && is_array($validatedData['features'])) {
            $project->features()->attach($validatedData['features']);
        }

        return new ProjectResource($project);

        // return new ProjectResource(Project::create($request->all()));

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
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
    public function update(UpdateProjectRequest $request, Project $project)
    {
        Log::info('CONTROLLER: Incoming request to update project:', [
            'request_data' => $request->all(),
            'project_id' => $project->id
        ]);

        $validatedData = $request->validated();
        
        $updateDate = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ];

        if (isset($validatedData['imageUrl'])){
            $updateDate['image_url'] = $validatedData['imageUrl'];
        }

        $project->update($updateDate);

        // Update features
        if (isset($validatedData['features']) && is_array($validatedData['features'])) {
            $project->features()->sync($validatedData['features']);
        }
        
        return new ProjectResource($project);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}
