<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::join('users_per_projects', 'users_per_projects.project_id', 'projects.id')
                    ->where('users_per_projects.user_id', $request->user()->id)
                    ->with('projectType')
                    ->limit(5)
                    ->get();
        
        return ProjectResource::collection($projects);
    }

    public function project(ProjectRequest $request, $key, $uuid)
    {
        $project = Project::where('key',$key)->whereUuid($uuid)->with('projectType')->first();

        return new ProjectResource($project);
    }

    public function store(StoreRequest $request)
    {
        if($request->input('only_validation')) return response()->json(['validated' => true], 200);

        $project = Project::create($request->all());

        return new ProjectResource($project);
    }
}
