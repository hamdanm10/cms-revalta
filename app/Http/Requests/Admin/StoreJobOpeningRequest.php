<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobOpeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string', 'max:65535'],
            'work_type'         => ['required', Rule::in(['remote', 'wfa', 'wfo', 'hybrid'])],
            'status'            => ['required', Rule::in(['open', 'closed'])],
            'slug'              => ['required', 'string', 'max:255', 'unique:job_openings,slug', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.',
        ];
    }
}
