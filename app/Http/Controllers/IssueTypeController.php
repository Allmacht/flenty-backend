<?php

namespace App\Http\Controllers;

use App\Http\Resources\IssueTypeResource;
use App\Models\IssueType;
use Illuminate\Http\Request;

class IssueTypeController extends Controller
{
    public function index()
    {
        return IssueTypeResource::collection(IssueType::where('name', '<>', 'Sub-task')->get());
    }
}
