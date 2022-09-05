<?php

namespace App\Http\Requests;

use App\Models\Message;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
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
            'post.title' => 'max:150',
            'post.description' => 'max:400',
            'post.content' => 'required',
            'post.published_at' => 'required',
            'post.image' => 'required',
        ];
    }
}
