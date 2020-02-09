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
            'link' => 'required',
            'start_date' => 'required|date',
            'description' => 'sometimes',
            'end_date' => 'required|date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'confirm' => 'sometimes|numeric',
        ];
    }
}
