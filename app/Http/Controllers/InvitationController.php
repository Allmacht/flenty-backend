<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invitation\StoreRequest;
use App\Models\Invitation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function store(StoreRequest $request)
    {
        $project = Project::whereUuid($request->project)->first();
        
        foreach($request->invitations as $invitation):

            $userId = User::whereEmail($invitation['email'])->where('id', '<>', $project->owner_id)->first()?->value('id');

            $inv = new Invitation();
            $inv->email      = $invitation['email'];
            $inv->role       = $invitation['role'];
            $inv->project_id = $project->id;
            $inv->user_id    = $userId ?? null;
            $inv->registered = $userId ? true : false;

            $inv->save();

        endforeach;

        return response()->json(['success' => true], 200);
    }
}
