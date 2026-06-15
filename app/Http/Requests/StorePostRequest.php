<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'Fk_userId',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'categories' => 'nullable|string',
            'subcategory' => 'nullable|string',
            'tags' => 'nullable|array',
            'excerpt' => 'nullable|string|max:500',
            'additionalImages' => 'nullable|array',
            'additionalImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'visibility' => 'nullable|in:public,private,unlisted',
            'publishDate' => 'nullable|date',
            'enableComments' => 'nullable|in:on',
            'showShareButtons' => 'nullable|in:on',
            'isFeatured' => 'nullable|in:on',
            'socialDescription' => 'nullable|string|max:200',
            'socialImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'author' => 'nullable|string|max:255',
            'readingTime' => 'nullable|integer|min:1',
            'customCssClass' => 'nullable|string|max:255',
            'tableOfContents' => 'nullable|in:on',
            'seoTitle' => 'nullable|string|max:255',
            'Description' => 'nullable|string|max:500',
            'urlSlug' => 'nullable|string|max:255|unique:posts,Slug',
            'noIndex' => 'nullable|string|in:on',
            'useCanonical' => 'nullable|in:on',
            'socialTitle' => 'nullable|string|max:255',
        ];
    }
}
