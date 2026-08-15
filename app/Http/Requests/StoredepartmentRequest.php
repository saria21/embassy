<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoredepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API to accept incoming new department configurations
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
            // 🟢 Ensures this sector is mapped back to a valid physical building/facility record
            "building_id" => ["required", "integer", "exists:related_buildings,building_id"],

            // 🟢 Forces strict string properties for official embassy segment tracking names
            "department_name" => ["required", "string", "max:255"],
        ];
    }
}
