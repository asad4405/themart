<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPhotoRequest extends FormRequest
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
            'photo' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg',
            'photo' => 'file|max:10000',
            'photo' => 'dimensions:min_width=400,min_height=400',
            'photo' => Rule::dimensions()->maxWidth(1000)->maxHeight(500)->ratio(3 / 2),
        ];
    }
    public function messages(): array
    {
        return [
            //
        ];
    }
}
