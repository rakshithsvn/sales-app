<?php

namespace App\Http\Requests;

class FacultyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->faculty ? ',' . $this->faculty->id : '';
        return $rules = [
            'faculty_name' => 'bail|required|max:255',
            'image' => 'bail|required|max:255',
            'excerpt' => 'bail|required|max:255',
        ];
    }
}
