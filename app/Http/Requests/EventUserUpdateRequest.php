<?php

namespace App\Http\Requests;

class EventUserUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->event_user->id;
        return $rules = [
            // 'username' => 'bail|required|min:3|max:255|unique:event_users,username,' . $id,
            // 'email' => 'bail|required|email|max:255|unique:event_users,email,' . $id
        ];
    }
}
