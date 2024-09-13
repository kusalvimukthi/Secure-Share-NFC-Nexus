<?php

namespace App\Http\Requests;

use App\Rules\NicValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->input('user_id') ?? Auth::user()->id;
        Log::info($this);

        return [
            'name' => 'required|string',
            'email' => ['required', Rule::unique('users')->ignore($userId),],
            'tel_no' => 'nullable|string',
            'address' => 'nullable|string',
            'town' => 'nullable|string',
            'state' => 'nullable|string',
            'post_code' => 'nullable|string'
        ];
    }
}
