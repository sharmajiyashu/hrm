<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'date_of_birth' => 'required',
            'date_of_join' => 'required',
            'designation' => 'required',
            'salary' => 'required|numeric',
            'probation_end_date' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required'
        ];
    }
}
