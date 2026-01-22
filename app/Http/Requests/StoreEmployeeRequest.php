<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'department_id'=>'required|exists:departments,id',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:employees,email',
            'contacts'=>'required|array',
            'contacts.*.contact_number'=>'required',
            'addresses'=>'required|array',
            'contacts.*.address'=>'required',
        ];
    }
}
