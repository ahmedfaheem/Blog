<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["Required", "min:3", Rule::unique('posts', 'title')->ignore($this->route('id'))],
            "description" => "Required|min:10",
            "author_id"  => "required|exists:users,id",
            "image"      => [$this->isMethod('POST') ? 'required' : 'sometimes', 'nullable', File::types(['png', 'jpg'])]
        ];
    }

    public function messages():array
    {
        return [
          "title.min" => "Post Title must be at least 3 characters",
          "description.min" => "Post Description must be at least 10 characters"
        ];
    }
}
