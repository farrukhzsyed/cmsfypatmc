<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Crypt;
use Auth;
use App\Rules\Alpha_spaces;
use App\Rules\Email;

class NewClientRequest extends FormRequest
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
            'fname' => ['required', 'string', 'max:255', new Alpha_spaces()],
            'username' => 'required|string|max:255|alpha_dash|unique:clients',
            'email' => ['required', 'string', 'email',new Email(),'max:255', 'unique:clients'],
            'tel' => 'required|numeric|max:9999999999999999|unique:clients',
            'gender' => 'required|string',
        ];
    }

     /**
     * Get the error messages that should be displayed if validation fails.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tel.max' => 'The tel must not exceed 16 digits',
        ];
    }
}
            