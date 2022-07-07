<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subtask\DeleteRequest;
use App\Http\Requests\Subtask\StoreRequest;
use App\Http\Requests\Subtask\SubtaskRequest;
use App\Http\Requests\Subtask\UpdateRequest;
use App\Http\Resources\SubtaskResource;
use App\Models\Subtask;

class SubtaskController extends Controller
{
    public function index(SubtaskRequest $request)
    {
        $subtasks = Subtask::whereIssueId($request->issue_id)->OrderBy('id', 'desc')->get();

        return SubtaskResource::collection($subtasks);
    }

    public function store(StoreRequest $request)
    {
        $subtask = Subtask::create($request->all());

        if($request->value !== 100) Subtask::whereIssueId($request->issue_id)->update(['value' => $request->value]);

        return new SubtaskResource($subtask);
    }

    public function update(UpdateRequest $request)
    {
        Subtask::whereIssueId($request->issue_id)
                ->whereId($request->subtask_id)
                ->update([
                    'subtask' => $request->subtask
                ]);

        return response()->json(['success' => true], 200);
    }

    public function delete(DeleteRequest $request)
    {
        Subtask::whereId($request->subtask_id)->delete();
        
        Subtask::whereIssueId($request->issue_id)->update(['value' => $request->value]);

        return response()->json(['success' => true], 200);
    }
}
