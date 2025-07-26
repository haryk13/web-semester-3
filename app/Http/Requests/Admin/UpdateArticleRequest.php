<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole(['admin', 'editor']);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|url', // Changed to accept URL from separate upload
            'current_image' => 'nullable|string', // For keeping existing image
            'remove_image' => 'boolean', // For removing current image
            'is_published' => 'boolean',
            'reading_time' => 'nullable|integer|min:1|max:999',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Article title is required.',
            'title.max' => 'Article title cannot exceed 255 characters.',
            'excerpt.required' => 'Article excerpt is required.',
            'excerpt.max' => 'Article excerpt cannot exceed 500 characters.',
            'content.required' => 'Article content is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'image.url' => 'Image must be a valid URL.',
            'reading_time.integer' => 'Reading time must be a number.',
            'reading_time.min' => 'Reading time must be at least 1 minute.',
            'reading_time.max' => 'Reading time cannot exceed 999 minutes.',
            'tags.array' => 'Tags must be an array.',
            'tags.*.exists' => 'One or more selected tags do not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }
}
