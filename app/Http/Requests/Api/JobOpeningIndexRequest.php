<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobOpeningIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'    => ['nullable', 'string', 'max:100'],
            'work_type' => ['nullable', 'string', Rule::in(['remote', 'onsite', 'hybrid'])],
            'status'    => ['nullable', 'string', Rule::in(['open', 'closed'])],
            'per_page'  => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
