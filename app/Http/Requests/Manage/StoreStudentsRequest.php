<?php
namespace App\Http\Requests\Manage;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_phone' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'citizenship_issue_date' => 'nullable|date_format:'.config('app.date_format'),
            'email' => 'required|email',
            'date_of_birth' => 'required|date_format:'.config('app.date_format'),
            'dept_id'=>'required'
        ];
    }
}