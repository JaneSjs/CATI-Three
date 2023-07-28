<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuotaRequest extends FormRequest
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
            'schema_id' => Rule::unique('quotas')->where(function($query) {
                return $query->where('schema_id', $this->input('schema_id'));
            })
        ];
    }

    // Custom Error Messages
    public function messages()
    {
        return [
            'schema_id.unique' => 'Quota Criteria For That Survey Had Already Been Set.',
        ];
    }
}
