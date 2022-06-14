<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Models\Line;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function index(Request $request)
    {
        $lines = Line::whereCompany_id($request->input('company_id'))->whereStatus(true)->get();
        return LineResource::collection($lines);
    }
}
