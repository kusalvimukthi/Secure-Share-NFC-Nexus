<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BusinessCardUpdateRequest extends FormRequest
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
        return [
            'card_id' => "required|integer|exists:business_cards,id",
            'name' => 'required|string',
            'tel_no' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'company_name' => 'required|string',
            'designation' => 'required|string',
            'businessCardAvatar' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'sometimes|nullable|string',
            'webLink' => 'sometimes|nullable|url',
            'portfolio' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'facebook' => 'sometimes|nullable|url',
            'linkedin' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url'
        ];
    }
}
