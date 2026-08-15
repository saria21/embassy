<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatestaffRequest extends FormRequest
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
            // 🟢 Swaps "required" for "sometimes" to handle partial employee record shifts safely
            "department_id" => ["sometimes", "integer", "exists:departments,department_id"],
            "first_name" => ["sometimes", "string", "max:100"],
            "last_name" => ["sometimes", "string", "max:100"],
            "role" => ["sometimes", "string", "in:Security Guard,Visa Officer,Consular Officer,Interviewer,Ambassador"],
        ];
    }
}
