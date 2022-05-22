<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class SongRequest extends FormRequest
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
            'text-edit-song'=>['required',
                'min:3'
            ],
            'artistId'=>[
                'required'
            ],
            'artist'=>[
                'required'
            ],
            'name'=>[
                'required'
            ],
            'type'=>[
                'not_in:0'
            ]
        ];
    }
}
