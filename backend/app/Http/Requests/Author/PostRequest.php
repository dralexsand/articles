<?php

namespace App\Http\Requests\Author;

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
            'user_id' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
        ];
    }
}
