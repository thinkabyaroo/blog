<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create',Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|min:3|unique:posts,title',
            'category'=>'required|exists:categories,id',
            'description'=>'required|min:10',
            'photos'=>'required',
            'photos.*'=>'file|mimes:jpg,png|max:1024',
            'tags'=>'required',
            'tags.*'=>'exists:tags,id',
        ];
    }

    //custom message
    public function messages()
    {
        return [
            "title:required"=>"title",
        ];
    }
}
