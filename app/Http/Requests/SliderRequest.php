<?php

namespace App\Http\Requests;

class SliderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->slider ? ',' . $this->slider->id : '';
        return $rules = [
            'title' => 'bail|required|max:255',
            'image' => 'bail|required|max:255',
            'excerpt' => 'bail|required|max:255',
        ];
    }
}
