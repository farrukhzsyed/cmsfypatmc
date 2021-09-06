<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Crypt;
use Auth;

class ClientRequest extends FormRequest
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
            'username' => 'sometimes|string|max:255|unique:clients,id,'.Crypt::decrypt($this->clientId),
            'email' => 'required|string|email|max:255|unique:clients,id,'.Crypt::decrypt($this->clientId),
            'tel' => 'sometimes|string|unique:clients,id,'.Crypt::decrypt($this->clientId),
            'address' => 'sometimes|string',
            'gender' => 'required|string',
            'avatar' => 'sometimes|mimes:jpeg,jpg,png,gif',
        ];
    }
}
