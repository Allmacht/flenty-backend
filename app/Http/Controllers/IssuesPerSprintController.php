<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssuesPerSprint\BoardRequest;
use App\Http\Requests\IssuesPerSprint\DeleteRequest;
use App\Http\Requests\IssuesPerSprint\IssueSprintRequest;
use App\Http\Requests\IssuesPerSprint\IssuesRequest;
use App\Http\Requests\IssuesPerSprint\StoreRequest;
use App\Http\Requests\IssuesPerSprint\UpdateRequest;
use App\Http\Resources\IssuePerSprintResource;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use App\Models\IssuesPerSprint;

class IssuesPerSprintController extends Controller
{
    public function issue(IssueSprintRequest $request)
    {
        $register = IssuesPerSprint::with('sprint', 'workflow')->whereIssueId($request->issue_id)->first();

        return $register ? new IssuePerSprintResource($register) : response()->json(['exists' => false], 422);
    }

    public function issues(IssuesRequest $request)
    {
        $issuesIds = IssuesPerSprint::whereSprintId($request->sprint_id)->pluck('issue_id')->toArray();

        $issues = Issue::with(['issue_type', 'priority', 'assignee'])->whereIn('id', $issuesIds)->get();

        return IssueResource::collection($issues);
    }

    public function store(StoreRequest $request)
    {
        $verify = IssuesPerSprint::whereIssueId($request->issue_id)->whereSprintId($request->sprint_id)->first();

        if(null !== $verify)
        {
            $verify->update(['sprint_id' => $request->sprint_id]);

            return response()->json(['success' => true, 'updated' => true], 200);
        }

        IssuesPerSprint::create($request->all());

        return response()->json(['success' => true], 200);
    }

    public function update(UpdateRequest $request)
    {
        IssuesPerSprint::whereSprintId($request->sprint_id)->whereIssueId($request->issue_id)->update([
            'workflow_id' => $request->workflow
        ]);

        return response()->json(['success' => true, 'updated' => true], 200);
    }

    public function delete(DeleteRequest $request)
    {
        IssuesPerSprint::whereSprintId($request->sprint_id)->whereIssueId($request->issue_id)->delete();
        return response()->json(['success' => true], 200);
    }
}
