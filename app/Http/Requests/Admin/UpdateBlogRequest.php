<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $blog = $this->route('blog');

        return [
            'category_id'       => ['required', 'integer', Rule::exists('blog_categories', 'id')->whereNull('deleted_at')],
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('blogs', 'slug')->ignore($blog->id)],
            'thumbnail'         => ['nullable', 'image', 'max:2048'],
            'short_description' => ['required', 'string', 'max:255'],
            'content'           => ['required', 'string'],
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
