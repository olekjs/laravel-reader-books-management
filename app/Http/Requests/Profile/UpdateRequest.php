<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'aboutMe'       => 'string|max:1000',
            'city'          => 'string|max:200',
            'country'       => 'string|max:200',
            'favoriteBooks' => 'string|max:600',
            'firstName'     => 'string|max:200',
            'lastName'      => 'string|max:200',
        ];
    }
}
