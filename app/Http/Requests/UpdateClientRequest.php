<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|numeric|digits_between:10,12',
            'email' => 'required|email',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'nullable',
            'company_name' => 'required',
            'gst_number' => 'nullable'
        ];
    }
}
