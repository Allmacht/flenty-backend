<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function prepareForValidation()
    {
        $this->merge(['comment_id' => $this->route()->id]);
    }

    public function authorize()
    {
        return Comment::whereKey($this->route()->id)->whereUserId($this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment_id' => 'required|integer|exists:comments,id',
            'comment'    => 'required|string|max:500'
        ];
    }
}
