<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatecitizenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED
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
            // 🟢 Swaps "required" for "sometimes" for flexible edits. 
            // 🟢 The unique rule ignores the current citizen's ID so it doesn't trigger a false error when saving their own passport!
            "passport_number" => ["sometimes", "string", "max:50", "unique:citizen,passport_number," . $this->route('citizen')?->citizen_id],

            // 🟢 Optional profile text edits
            "full_name" => ["sometimes", "string", "max:255"],

            // 🟢 Optional address location updates
            "current_address" => ["sometimes", "string", "max:500"],
        ];
    }
}
