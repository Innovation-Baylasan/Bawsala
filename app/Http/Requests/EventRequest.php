<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entity_id' => 'sometimes',
            'name' => 'required',
            'link' => 'required|url',
            'description' => 'sometimes',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'confirm' => 'sometimes|numeric',
        ];
    }
}
