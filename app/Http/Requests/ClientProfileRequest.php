<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Auth;
class ClientProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:clients,username,'.Auth::guard('client')->user()->id,
            'email' => 'required|string|email|max:255|unique:clients,email,'.Auth::guard('client')->user()->id,
            'tel' => 'required|string|unique:clients,tel,'.Auth::guard('client')->user()->id,
            'address' => 'required|string',
            'gender' => 'required|string',
            'avatar' => 'sometimes|mimes:jpeg,jpg,png,gif',
        ];
    }
}
