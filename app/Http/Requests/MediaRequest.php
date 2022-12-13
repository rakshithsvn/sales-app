<?php

namespace App\Http\Requests;

class MediaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->album ? ',' . $this->album->id : '';

        return $rules = [
            'category' => 'bail|required|max:255',
            'title' => 'bail|required|max:255',
            'slug' => 'bail|required|max:255|unique:media_albums,slug' . $id,
        ];
    }
}
