<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rname' => 'required|max:50',
            'serving' => 'required|integer|max:10',
            'image' => 'required',
            'rcomment' => 'max:255',
            'iid' => 'array|min:1',
            'iid.0' => 'required',
            'amount' => 'array|min:1',
            'amount.0' => 'required',
            'amount.*' => 'max:9999',
            'steps_comment' => 'array|min:1',
            'steps_comment.0' => 'required',
            'steps_comment.*' => 'max:255',
        ];
    }
}
