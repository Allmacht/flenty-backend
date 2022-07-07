<?php

namespace App\Http\Requests\Comment;

use App\Models\Issue;
use App\Models\Project;
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
        $issue = Issue::whereProjectId(Project::where('key', $this->route()->key)->whereUuid($this->route()->uuid)->first()->value('id'))
                    ->where('key', $this->route()->issue)
                    ->first();
                    
        $this->merge(['issue_id' => $issue->id, 'uuid' => $this->route()->uuid]);
    }

    public function authorize()
    {
        return UsersPerProject::
                    whereProject_id(Project::whereUuid($this->uuid)->first()->value('id'))
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
            'comment'  => 'required|string|max:500',
            'issue_id' => 'required|integer|exists:issues,id',
            'uuid'     => 'required|uuid|exists:projects,uuid',
            'user_id'  => 'required|integer|exists:users,id'
        ];
    }
}
