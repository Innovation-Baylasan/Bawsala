<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entity_id' => 'required',
            'picture' => 'required',
            'name' => 'required',
            'link' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'confirm' => 'sometimes|numeric',
        ];
    }
}
