<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'author_id' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coverImage' => 'nullable|string|url',
            'publicationDate' => 'required|date',
            'genres_id' => 'required|array',
            'genres_id.*' => 'exists:genres,id',
        ];
    }
}
