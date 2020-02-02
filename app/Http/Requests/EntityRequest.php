<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntityRequest extends FormRequest
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
     * Customizing the attributes keys when returning error messages
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'category_id' => 'category',
            'longitude' => 'location',
            'latitude' => 'location',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required',
            'avatar' => 'sometimes|required',
            'cover' => 'sometimes|required',
            'description' => 'required',
            'details' => 'sometimes|required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }
}
