<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\EntityRequestInterface;

class UpdateRequest extends PostRequest implements EntityRequestInterface
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
        $rules = [];

        return array_merge($rules, parent::rules());
    }
}
