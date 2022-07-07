<?php

namespace App\Http\Requests\Subtask;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Project, Issue};

class SubtaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $project = Project::whereUuid($this->route()->project)->first();
        $issue   = Issue::where('key', $this->route()->issue)->whereProjectId($project->id)->first();
        

        if(null !== $project && null !== $issue)
        {
            $this->merge([
                'project_id'  => $project?->id,
                'issue_id'    => $issue?->id,
                'owner_id'    => $project?->owner_id,
                'reporter_id' => $issue?->reporter_id,
            ]);
        }

    }
    
    public function authorize()
    {
        return $this->user()->id === $this->owner_id || $this->user()->id === $this->reporter_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_id' => 'required|integer',
            'issue_id'   => 'required|integer',
        ];
    }
}
