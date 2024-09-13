<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWalletRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];

        foreach ($this->all() as $key => $value) {
            if (preg_match('/^url-(\d+)$/', $key, $matches)) {
                $index = $matches[1];

                if ($index == 1) {
                    $rules[$key] = 'required|url';
                } else {
                    $rules[$key] = 'nullable|url';
                }
            }

            if (preg_match('/^username-(\d+)$/', $key, $matches)) {
                $index = $matches[1];

                if ($index == 1) {
                    $rules[$key] = 'required|string';
                } else {
                    $rules[$key] = 'nullable|string|max:255';
                }
            }

            if (preg_match('/^password-(\d+)$/', $key, $matches)) {
                $index = $matches[1];

                if ($index == 1) {
                    $rules[$key] = 'required|string|min:6';
                } else {
                    $rules[$key] = 'nullable|string|min:6';
                }
            }
        }

        $otherRules = [
            'wallet_id' => 'required|int|exists:wallets,id',
            'editor_data' => 'sometimes|nullable|string',
            'note' => 'sometimes|nullable|string'
        ];
        return array_merge($rules, $otherRules);
    }
}
