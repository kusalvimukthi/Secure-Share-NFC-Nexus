<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageTagStatusUpdateRequest extends FormRequest
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
            'card_id' => "required|integer|exists:storage_tags,id",
            'status' => "required|string|in:true,false"
        ];
    }
}
