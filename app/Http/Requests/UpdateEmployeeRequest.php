<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:employees,email,' . $this->route('employee'),
            'department_id' => 'sometimes|required|exists:departments,id',
            'contacts' => 'sometimes|array',
            'contacts.*.contact_number' => 'required_with:contacts|string',
            'contacts.*.type' => 'required_with:contacts|string',
            'contacts.*.id' => 'sometimes|exists:employee_contacts,id',
            'addresses' => 'sometimes|array',
            'addresses.*.address' => 'required_with:addresses|string',
            'addresses.*.city' => 'required_with:addresses|string',
            'addresses.*.state' => 'required_with:addresses|string',
            'addresses.*.pincode' => 'required_with:addresses|string',
            'addresses.*.country' => 'required_with:addresses|string',
            'addresses.*.id' => 'sometimes|exists:employee_addresses,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
