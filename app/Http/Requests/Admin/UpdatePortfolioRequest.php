<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $portfolio = $this->route('portfolio');

        return [
            'category_id'       => ['required', 'integer', Rule::exists('portfolio_categories', 'id')->whereNull('deleted_at')],
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string', 'max:65535'],
            'thumbnail'         => ['nullable', 'image', 'max:2048'],
            'slug'              => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('portfolios', 'slug')->ignore($portfolio->id)],
            'status'            => ['required', Rule::in(['published', 'draft'])],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex'    => 'The slug may only contain lowercase letters, numbers, and hyphens.',
            'thumbnail.max' => 'The thumbnail must not be larger than 2MB.',
        ];
    }
}
