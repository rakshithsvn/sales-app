<?php

namespace App\Http\Requests;

class ExternalRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->post_link_page ? ',' . $this->post_link_page->id : '';

        return $rules = [
            'title' => 'bail|required|max:255|unique:post_link_pages,title' . $id,
        ];
    }
}
