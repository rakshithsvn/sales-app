<?php

namespace App\Http\Requests;

class EventUserCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return $rules = [
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|email|max:255|unique:event_users,email,',
            'username' => 'bail|required|min:3|max:255|unique:event_users,username,',
            'password' => 'required|min:3',
            'password_confirm' => 'required|min:3|same:password'
        ];
    }
}
