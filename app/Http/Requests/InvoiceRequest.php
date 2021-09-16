<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Auth;

class InvoiceRequest extends FormRequest
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
            'projectId' => 'required|numeric|exists:projects,id', 
            // 'invoiceSerial' => 'required|string|unique:invoices', 
            'dueDate' => 'required|date', 
            'amountToPay' => 'required|numeric', 
        ];
    }
}
