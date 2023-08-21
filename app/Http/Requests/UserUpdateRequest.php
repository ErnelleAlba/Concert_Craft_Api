<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'sometimes|required',
            'lastName' => 'sometimes|required',
            'age' => 'sometimes|required|numeric|between:18,100 ',
            'username' => 'sometimes|required|unique:users,username',
            'role' => 'sometimes|required',
            'email' => 'sometimes|required|unique:users|email:rfc',
            'password' => 'sometimes|required|min:8',
            'phone' => 'sometimes|required|numeric|digits:10',
            'address' => 'sometimes|required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ]));  
    }
}
