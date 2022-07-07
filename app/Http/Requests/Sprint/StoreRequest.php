<?php

namespace App\Http\Requests\Sprint;

use App\Models\Project;
use App\Models\Sprint;
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
        $project = Project::where('key', $this->route()->key)->whereUuid($this->route()->uuid)->first();

        $sprints = Sprint::whereProjectId($project->id)->count();

        $key = $project->key."-S01";

        if($sprints > 0) $key = $this->generateKey($project->key, $project->id);

        if(null !== $project)
        {
            $this->merge([
                'key'                        => $key,
                'project_id'                 => $project->id,
                'owner_id'                   => $project->owner_id,
                'project_initial_date'       => $project->initial_date,
                'project_projected_end_date' => $project->projected_end_date,
            ]);
        }
    }

    public function generateKey($key, $id)
    {
        $last_sprint = Sprint::whereProjectId($id)->latest()->first();
        $keys        = explode('-', $last_sprint->key);
        $number      = (int)substr($keys[1], 1) + 1;

        if(strlen((string)$number) < 2)
        {
            $number = str_pad((string)$number, 2, "0", STR_PAD_LEFT);
        }

        return $key."-S".$number;
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
            'key'                        => 'required|string',
            'project_id'                 => 'required|numeric',
            'owner_id'                   => 'required|numeric',
            'project_initial_date'       => 'required|date',
            'project_projected_end_date' => 'required|date',
            'initial_date'               => 'required|date|after_or_equal:project_initial_date',
            'projected_end_date'         => 'required|date|before_or_equal:project_projected_end_date',
            'name'                       => 'required|string',
            'goal'                       => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'initial_date.after_or_equal'        => 'La fecha inicial del Sprint debe ser mayor o igual a la fecha del inicio del proyecto',
            'projected_end_date.before-or_equal' => 'La fecha final del Sprint debe ser menor o igual a la fecha final del proyecto'
        ];
    }
}
