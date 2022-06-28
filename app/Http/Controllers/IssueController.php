<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\StoreRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(ProjectRequest $request, $key, $uuid)
    {
        $issues = Issue::with(['issue_type','priority', 'assignee'])
                ->whereProject_id(Project::where('key', $key)->whereUuid($uuid)->first()?->value('id'))->get();

        return IssueResource::collection($issues);
    }

    public function store(StoreRequest $request)
    {
        $issue = Issue::create($request->all());

        return new IssueResource($issue);
    }

    public function issue(ProjectRequest $request, $key, $uuid, $issue)
    {
        $issue = Issue::with(['assignee', 'reporter', 'priority', 'issue_type', 'files', 'comments', 'subtasks'])
                ->whereProject_id(Project::where('key', $key)->whereUuid($uuid)->first()?->value('id'))
                ->where('key', $issue)
                ->first();

        return new IssueResource($issue);
    }
}
