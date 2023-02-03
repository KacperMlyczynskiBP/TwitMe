<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'contact_name' =>'required',
            'contact_email' => 'required|email',
            'contact_phone_number' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_zip' => 'required|max:5',
            'company_vat' => 'required|max:5|integer',
        ];
    }
}
