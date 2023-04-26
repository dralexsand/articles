<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\EntityRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest implements EntityRequestInterface
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
            'author_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:3000'],
        ];
    }
}
