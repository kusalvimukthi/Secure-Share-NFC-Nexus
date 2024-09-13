<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePetTagRequest extends FormRequest
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
            if (preg_match('/^vaccine_(\d+)$/', $key, $matches)) {
                $rules[$key] = 'nullable|sometimes|string';
            }

            if (preg_match('/^vaccination_date_(\d+)$/', $key, $matches)) {
                $rules[$key] = 'date|nullable|sometimes';
            }

            if (preg_match('/^next_vaccination_date_(\d+)$/', $key, $matches)) {
                $rules[$key] = 'date|nullable|sometimes';
            }
        }

        $otherRules = [
            'pet_tag_id' => 'required|integer|exists:pet_tags,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'tel_no' => 'required|string',
            'address' => 'required|string',
            'petAvatar' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'sometimes|nullable|string',
            'pet_name' => 'required|string',
            'date_of_birth' => 'date|required',

        ];
        return array_merge($rules, $otherRules);
    }
}
