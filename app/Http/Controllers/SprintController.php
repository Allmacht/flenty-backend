<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sprint\SprintsRequest;
use App\Http\Requests\Sprint\SprintRequest;
use App\Http\Requests\Sprint\StoreRequest;
use App\Http\Resources\SprintResource;
use App\Models\Sprint;

class SprintController extends Controller
{
    public function index(SprintsRequest $request)
    {
        $sprints = Sprint::whereProjectId($request->project_id)->whereNull('final_date')->get();

        return SprintResource::collection($sprints);
    }

    public function sprint(SprintRequest $request)
    {
        $sprint = Sprint::with('workflows')->findOrFail($request->sprint_id);

        return new SprintResource($sprint);
    }
    
    public function store(StoreRequest $request)
    {
        $sprint = Sprint::create($request->all());

        return new SprintResource($sprint->load('workflows'));
    }
}
