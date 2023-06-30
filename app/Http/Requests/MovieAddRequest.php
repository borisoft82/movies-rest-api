<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function validationData()
    {
        $data = parent::validationData();
        $data['user_id'] = auth()->user()->id;

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:movies|max:255',
            'storyline' => 'required|string',
            "image" => 'nullable',
            'director' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'cast' => 'required|string|max:255',
            'user_id' => 'exists:users,id',
            'genre_id' => 'exists:genres,id'
        ];
    }
}
