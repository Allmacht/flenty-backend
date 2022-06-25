<?php

namespace App\Http\Requests\Project;

use App\Models\Project;
use App\Models\UsersPerProject;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        $this->merge(['key' => $this->route('key'), 'uuid' => $this->route('uuid')]);
    }

    public function authorize()
    {

        return UsersPerProject::
                    whereProject_id(Project::whereUuid($this->uuid)->first()?->value('id'))
                    ->whereUser_id($this->user()->id)
                    ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'key'  => 'required|string|exists:projects,key',
            'uuid' => 'required|string|uuid|exists:projects,uuid',
        ];
    }
}
