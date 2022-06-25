<?php

namespace App\Http\Requests\Invitation;

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
        $projectOwner = Project::whereUuid($this->project)->first()->value('owner_id');
        return $projectOwner === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project'             => 'required|string|uuid|exists:projects,uuid',
            'invitations.*.email' => 'required|string|email',
            'invitations.*.role'  => 'required|string|exists:roles,name'
        ];
    }
}
