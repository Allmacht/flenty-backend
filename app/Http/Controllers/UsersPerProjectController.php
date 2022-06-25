<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersPerProjectResource;
use App\Models\Project;
use App\Models\UsersPerProject;
use Illuminate\Http\Request;

class UsersPerProjectController extends Controller
{
    public function index(Request $request, $uuid)
    {
        $projectId = Project::whereUuid($uuid)->first()?->value('id');
        $members = UsersPerProject::whereProject_id($projectId)->with(['user','role'])->get();

        return UsersPerProjectResource::collection($members);
    }

}
