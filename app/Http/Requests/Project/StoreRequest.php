<?php

namespace App\Http\Requests\Project;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():Array
    {
        return [
            'key'                => 'required|string|max:4',
            'name'               => 'required',
            'initial_date'       => 'required|date|after_or_equal:today',
            'projected_end_date' => 'required|date|after:initial_date',
            'company_id'         => 'required|numeric|exists:companies,id',
            'line_id'            => 'required|numeric|exists:lines,id'
        ];
    }

    public function messages():Array
    {

        return [
            'initial_date.after_or_equal' => 'La fecha de inicio debe ser mayor o igual al día de hoy',
            'projected_end_date.after'    => 'La fecha final estimada debe ser mayor a la fecha de inicio'     
        ];

    }
}
