<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'extNo' => 'nullable|integer|numeric|max:10000|min:100|unique:users,ext_no',
            'phone1' => 'nullable|max:20|unique:users,phone_1',
            'phone2' => 'nullable|max:20|unique:users,phone_2',
            'gender' => 'nullable|string|max:10'
        ];
    }
}
