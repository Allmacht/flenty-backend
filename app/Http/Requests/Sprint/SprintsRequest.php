<?php

namespace App\Http\Requests\Sprint;

use App\Models\Project;
use App\Models\UsersPerProject;
use Illuminate\Foundation\Http\FormRequest;

class SprintsRequest extends FormRequest
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
            $this->merge([
                'project_id' => $project->id,
                'user_id'    => $this->user()->id,
            ]);
        }
    }

    public function authorize()
    {
        return UsersPerProject::whereProjectId($this->project_id)->whereUserId($this->user_id)->exists();
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
        ];
    }
}
