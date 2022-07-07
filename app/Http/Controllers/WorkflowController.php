<?php

namespace App\Http\Controllers;

use App\Http\Requests\Workflow\IssuesRequest;
use App\Http\Requests\Workflow\WorkflowRequest;
use App\Http\Resources\IssueResource;
use App\Http\Resources\WorkflowResource;
use App\Models\Issue;
use App\Models\IssuesPerSprint;
use App\Models\Workflow;

class WorkflowController extends Controller
{
    public function index(WorkflowRequest $request)
    {
        $workflows = Workflow::whereSprintId($request->sprint_id)->get();

        return WorkflowResource::collection($workflows);
    }

    public function issues(IssuesRequest $request)
    {
        $issuesIds = IssuesPerSprint::whereSprintId($request->sprint_id)
                    ->whereWorkflowId($request->workflow_id)
                    ->pluck('issue_id')
                    ->toArray();

        if(count($issuesIds) === 0) return response()->json(['empty' => true], 200);

        $issues = Issue::with(['issue_type','priority', 'assignee'])
                ->whereProjectId($request->project_id)
                ->whereIn('id', $issuesIds)
                ->get();

        
        return IssueResource::collection($issues);

    }
}
