<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest 
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:blog_posts|min:7',
        // 'body' => 'bail|required|min:10',
        'editor' => 'required',
        'photo' => 'required|image|max:2048',
        'publish' => 'required',
        'catname' => 'required',

        ];
    }
    public function messages(): array
{
    return [
        // 'title.required' => 'Love You',
        // 'body.required' => 'A choti body is required',
        'photo.max' => 'Photo must not be grater than 1 Mega Bytes',  
        'photo.image' => 'File format is not supported', 
    ];
}
}
