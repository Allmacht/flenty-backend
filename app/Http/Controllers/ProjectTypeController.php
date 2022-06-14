<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectTypeResource;
use Illuminate\Http\Request;
use App\Models\ProjectType;

class ProjectTypeController extends Controller
{
    public function index(Request $request)
    {
        return ProjectTypeResource::collection(ProjectType::all());
    }
}
