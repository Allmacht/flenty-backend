<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachedFile\DeleteRequest;
use App\Http\Requests\AttachedFile\DownloadRequest;
use App\Http\Requests\AttachedFile\FilesRequest;
use App\Http\Requests\AttachedFile\StoreRequest;
use App\Http\Resources\AttachedFileResource;
use Illuminate\Support\Facades\Storage;
use App\Models\AttachedFile;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;
use Exception;

class AttachedFileController extends Controller
{

    public function index(FilesRequest $request, $uuid, $issue)
    {
        $project = Project::whereUuid($uuid)->first();
        $issue   = Issue::where('key', $issue)->whereProject_id($project->id)->first();

        $files = AttachedFile::whereIssueId($issue->id)->get();

        return AttachedFileResource::collection($files);
    }

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

    public function download(DownloadRequest $request, $uuid, $issue, $file)
    {
        if(!Storage::disk('issue_files')->exists($file)) return response()->json(['success' => false], 422);

        return  Storage::disk('issue_files')->download($file);
        
    }

    public function delete(DeleteRequest $request, $uuid, $issue, $file)
    {

        try{

            if(Storage::disk('issue_files')->exists($file)){
                Storage::disk('issue_files')->delete($file);
            }

            AttachedFile::whereFile($file)->delete();
            return response()->json(['sucess' => true], 200);

        }catch(Exception $e){

            return response()->json(['sucess' => false, 'error' => $e], 500);
            
        }
    }
}
