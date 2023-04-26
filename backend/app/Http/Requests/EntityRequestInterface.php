<?php

namespace App\Http\Requests;

interface EntityRequestInterface
{
    public function authorize(): bool;

    public function rules(): array;
}