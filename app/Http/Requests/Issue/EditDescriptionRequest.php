<?php

namespace App\Http\Requests\Issue;

use App\Models\Issue;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class EditDescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project = Project::where('key', $this->route()->key)->whereUuid($this->route()->uuid)->first();

        
        if(null !== $project)
        {
            $issue = Issue::where('key', $this->route()->issue)->whereProjectId($project->id)->first();

            $this->merge([
                'project_id' => $project->id,
                'owner_id'   => $project->owner_id,
                'issue_id'   => $issue?->id,
            ]);
        }
    }

    public function authorize()
    {
        return $this->user()->id === $this->owner_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_id'  => 'required|numeric',
            'owner_id'    => 'required|numeric',
            'issue_id'    => 'required|numeric',
            'description' => 'required'
        ];
    }
}
