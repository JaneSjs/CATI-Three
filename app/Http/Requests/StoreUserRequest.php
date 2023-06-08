<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ext_no' => 'required|integer|numeric|max:999|unique:users,ext_no',
            'email' => 'required|string|email|max:255|unique:users,email',
            'national_id' => 'required|min:7|max:20|unique:users,national_id',
            'phone_1' => 'required|max:20|unique:users,phone_1',
            'gender' => 'required|max:20',
        ];
    }
}
