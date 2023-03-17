<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlueCheckFormularRequest extends FormRequest
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
        'credit_card'=> 'required|digits:16|integer',
        'expiry'=>'required|date_format:m/y',
        'cvv'=>'required|digits:3|integer',
        'address_city'=>'required',
        'address_country'=>'required|string',
        ];
    }
}
