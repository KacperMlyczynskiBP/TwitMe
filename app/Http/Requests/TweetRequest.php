<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tweetRequest extends FormRequest
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
            'body' => 'required|max:255',
            'tweetMedia' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,video/mp4,video/quicktime,video/x-msvideo',
        ];
    }
}
