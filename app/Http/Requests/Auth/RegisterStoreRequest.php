<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class RegisterStoreRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'name'  => ucwords(strtolower($this->name)),
            'email' => strtolower($this->email)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->uncompromised()],
            'terms'    => 'required|boolean|accepted'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'El correo electrónico ingresado ya está en uso',
        ];
    }
}
