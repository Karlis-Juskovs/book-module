<?php

namespace Karlis\Module2\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Karlis\Module2\Models\Author;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // update when if auth system is enabled
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'author_id' => [
                'required',
                'int',
                function ($attribute, $value, $fail) {
                    if (!Author::where('id', $value)->exists()) {
                        $fail('Selected author not found.');
                    }
                },
            ],
            'release_date' => 'required|date',
            'eur_price' => 'required|numeric|between:0.01,99.99',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'author_id' => 'Author',
            'release_date' => 'Release date',
            'eur_price' => 'EUR price',
        ];
    }
}
