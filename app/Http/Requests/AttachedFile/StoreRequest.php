<?php

namespace App\Http\Requests\AttachedFile;

use App\Models\Issue;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    public function authorize()
    {
        $project = Project::whereUuid($this->route()->uuid)->first();
        if(!is_null($project)):
            $issue = Issue::where('key', $this->route()->key)->whereProject_id($project->id)->first();
            return $issue?->assignee_id === $this->user()->id || $project->owner_id === $this->user()->id;
        endif;

        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*' => 'file'
        ];
    }
}
