<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        
    }

    public function store(StoreRequest $request)
    {
        if($request->input('only_validation')) return response()->json(['validated' => true], 200);

        $project = Project::create($request->all());

        return new ProjectResource($project);
    }
}
