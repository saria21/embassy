<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorecitizenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API to accept incoming civilian profile registrations
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 🟢 ChatGPT Fix: points directly to the real plural database table 'citizens'
            "passport_number" => ["required", "string", "max:50", "unique:citizens,passport_number"],

            // 🟢 Standard strict layout parameters for human text profile names
            "full_name" => ["required", "string", "max:255"],

            // 🟢 Ensures current residential tracking metadata is safely recorded
            "current_address" => ["required", "string", "max:500"],
        ];
    }
}
