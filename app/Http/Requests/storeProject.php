<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProject extends FormRequest
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
                'title'=>'required|unique:projects',
                'image'=>'required',
                'github'=>'required|url',
                'website'=>'required|url|nullable',
                'created_at'=>'nullable|date',
                'updated_at'=>'nullable|date'
        ];
    }
}
