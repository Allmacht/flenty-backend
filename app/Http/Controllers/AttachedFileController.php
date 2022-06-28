<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachedFile\StoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\AttachedFile;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;
use Exception;

class AttachedFileController extends Controller
{
    public function store(StoreRequest $request, $uuid, $key)
    {
        $project = Project::whereUuid($uuid)->first();
        $issue   = Issue::where('key', $key)->whereProject_id($project->id)->first();


        if(!is_null($issue)):

            foreach($request->all() as $file)
            {
                try{
                    
                    $name = $file->hashName();
                    Storage::disk('issue_files')->put($name, file_get_contents($file));
                    
                    $new_file                = new AttachedFile();
                    $new_file->file          = $name;
                    $new_file->extension     = $file->extension();
                    $new_file->original_name = $file->getClientOriginalName();
                    $new_file->issue_id      = $issue->id;

                    $new_file->save();

                }catch(Exception $e){

                    return response()->json(['success' => false, 'error' => $e], 422);
                }
            }

            return response()->json(['success' => true], 200);

        endif;

        return response()->json(['success' => false], 422);
    }
}
