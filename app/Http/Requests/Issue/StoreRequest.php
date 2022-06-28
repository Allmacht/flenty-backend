<?php

namespace App\Http\Requests\Issue;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersPerProject;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project    = Project::whereUuid($this->route()->uuid)->where('key', $this->route()->key)->first()?->value('id');
        $last_issue = Issue::whereProject_id($project)->latest()->first();

        $key = "";

        if(is_null($last_issue)):

            $key = $this->route()->key."-001";

        else:

            $last_key = explode("-",$last_issue->key);

            $key = $last_key[0]."-".str_pad((int)++$last_key[1], 3, "0", STR_PAD_LEFT);
            
        endif;
        
        $this->merge(['project_id' => $project, 'key' => $key]);
    }

    public function authorize()
    {
        
        $project = Project::where('key',$this->route()->key)->whereUuid($this->route()->uuid)->first();

        if(!is_null($project)):

            $member = UsersPerProject::with('role')->whereProject_id($project->id)->whereUser_id($this->user()->id)->first();

            return $member && $member->role->name === 'Project-administrator' ? true : false;

        else:
            return false;
        endif;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'key'           => 'required|string',
            'summary'       => 'required|string',
            'duration'      => 'required|integer|min:1',
            'assignee_id'   => 'nullable|integer|exists:users,id',
            'reporter_id'   => 'required|integer|exists:users,id',
            'priority_id'   => 'required|integer|exists:priorities,id',
            'issue_type_id' => 'required|integer|exists:issue_types,id',
            'project_id'    => 'required|integer|exists:projects,id'
        ];
    }
}
