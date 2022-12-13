<?php

namespace App\Http\Requests;

class UserCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return $rules = [
            'name' => 'bail|required|max:255|unique:users,name,',
            'email' => 'bail|required|email|max:255|unique:users,email,',
            'password'         => 'required|min:3',
            'password_confirm' => 'required|min:3|same:password'
        ];
    }
}
