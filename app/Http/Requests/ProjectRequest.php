<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Auth;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255', 
            'serial' => 'sometimes|string|max:255', 
            'description' => 'required|string', 
            'requirement' => 'required|string', 
            'projectFile' => 'sometimes|nullable|mimes:xlsx,pdf,docx,doc,jpeg,jpg,png,gif', 
            'ownBy' => 'required|numeric|exists:clients,id', 
            'percentageComplete' => 'required|numeric|max:100', 
            'startDate' => 'required|date', 
            'completeDate' => 'sometimes|nullable|date', 
            'deliveryDate' => 'sometimes|nullable|date', 
            'isDelivered' => 'sometimes|boolean', 
            'feedback' => 'sometimes|string',
        ];
    }
}
