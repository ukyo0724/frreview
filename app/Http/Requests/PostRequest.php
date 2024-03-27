<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.title'=> 'required|string|max:20',
            'post.body'=>'required|string|min:50|max:400',
            'post.city'=>'required|string|max:50',
            'image[]'=>'mimes:gif,png,jpg,webp'|'max:3072',
            'post.address'=>'required|string|max:50',
        ];
    }
}
