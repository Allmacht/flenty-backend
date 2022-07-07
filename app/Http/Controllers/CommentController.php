<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\DeleteRequest;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Issue;
use App\Models\Project;

class CommentController extends Controller
{
    public function index(ProjectRequest $request, $key, $uuid, $issue)
    {
        $issue = Issue::whereProjectId(Project::where('key', $key)->whereUuid($uuid)->first()->value('id'))->where('key', $issue)->first();

        if(null === $issue) return response()->json(['success' => false], 422);

        $comments = Comment::with('user')->whereIssue_id($issue->id)->orderBy('created_at', 'desc')->get();

        return CommentResource::collection($comments);
    }

    public function store(StoreRequest $request)
    {
        $comment = Comment::create($request->all());

        return new CommentResource($comment);
    }

    public function update(UpdateRequest $request, $id)
    {
        Comment::whereId($id)->update([ 'comment' => $request->comment, 'edited' => true ]);
        
        return response()->json(['success' => true], 200);
    }

    public function delete(DeleteRequest $request, $id)
    {
        Comment::whereId($id)->delete();

        return response()->json(['success' => true], 200);
    }
}
