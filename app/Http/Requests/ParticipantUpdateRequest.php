<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantUpdateRequest extends FormRequest
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
            'church_id' => ['required', 'max:255'],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'type' => ['nullable', 'max:255'],
            'group' => ['nullable', 'numeric'],
            'gender' => ['required', 'in:male,female,other'],
            'image' => ['nullable', 'max:5000', 'file'],
        ];
    }
}
