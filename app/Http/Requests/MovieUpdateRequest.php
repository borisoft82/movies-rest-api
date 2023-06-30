<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->movie->user_id === auth()->user()->id) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|unique:movies|max:255',
            'storyline' => 'nullable|string',
            "image" => 'nullable',
            'director' => 'nullable|string|max:255',
            'writer' => 'nullable|string|max:255',
            'cast' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'genre_id' => 'nullable|exists:genres,id'
        ];
    }
}
