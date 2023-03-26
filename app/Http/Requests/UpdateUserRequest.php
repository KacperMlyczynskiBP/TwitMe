<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'user_image_path'=>'mimes:jpeg,bmp,png',
            'username' => ['string', 'max:255'],
            'bio'=> ['string', 'max:255'],
            'location'=> ['string', 'max:255'],
            'date_of_birth' => ['date', 'before:' . date('Y-m-d', strtotime("-".User::MIN_AGE." years"))
                , 'after:' . date('Y-m-d', strtotime("-". User::MAX_AGE." years"))],
        ];
    }
}
