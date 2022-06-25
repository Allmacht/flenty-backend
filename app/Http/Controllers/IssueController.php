<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\StoreRequest;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {

    }

    public function store(StoreRequest $request, $key, $uuid)
    {
        Issue::create($request->all());
    }
}
