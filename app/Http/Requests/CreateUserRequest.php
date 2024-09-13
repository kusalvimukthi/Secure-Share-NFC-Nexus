<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'tel_no' => 'required|string',
            'nic' => 'required|string',
            'address' => 'required|string',
            'town' => 'required|string',
            'state' => 'required|string',
            'post_code' => 'required|string',
            'status' => 'required|in:true,false'
        ];
    }
}
