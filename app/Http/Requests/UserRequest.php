<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,'.Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif,jpg|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'User name is required. ',
            'name.unique' => 'User name has already been taken. ',
            'avatar.dimensions' => 'Please upload an avatar bigger than 208 * 208 px. '
        ];
    }
}
