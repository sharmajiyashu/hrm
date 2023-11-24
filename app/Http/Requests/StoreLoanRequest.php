<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'loan_amount' => 'required|numeric',
            'rate_of_interest' => 'required|present',
            'tenure' => 'required|numeric',
            'emi_amount' => 'required|numeric',
            'emi_start' => 'required',
            'emi_end' => 'required',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
