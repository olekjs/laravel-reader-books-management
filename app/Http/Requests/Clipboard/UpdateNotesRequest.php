<?php

namespace App\Http\Requests\Clipboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotesRequest extends FormRequest
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
            'notes' => 'string|max:2400',
            'item_id' => 'integer'
        ];
    }
}
