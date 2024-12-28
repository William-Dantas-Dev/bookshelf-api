<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'author_id' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'coverImage' => 'nullable|string|url',
            'publicationDate' => 'sometimes|date',
            'genres_id' => 'sometimes|array',
            'genres_id.*' => 'exists:genres,id',
        ];
    }
}
