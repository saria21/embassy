<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorestaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API to accept incoming new staff registrations
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
            // 🟢 Ensures this employee is assigned to an existing, valid structural department division
            "department_id" => ["required", "integer", "exists:departments,department_id"],

            // 🟢 Standard layout parameters for the employee's legal name title
            "first_name" => ["required", "string", "max:100"],
            "last_name" => ["required", "string", "max:100"],

            // 🟢 Validates that their tracking assignment role strictly matches your physical embassy permission paths
            "role" => ["required", "string", "in:Security Guard,Visa Officer,Consular Officer,Interviewer,Ambassador"],
        ];
    }
}
