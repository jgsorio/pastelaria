<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreOrUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', Rule::unique('clients', 'email')->ignore($this->client)->whereNull('deleted_at')],
            'phone' => ['required'],
            'birthdate' => ['required'],
            'address' => ['required'],
            'neighborhood' => ['required'],
            'zipcode' => ['required']
        ];
    }
}
