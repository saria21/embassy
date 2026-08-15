<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Storevisa_applicationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API route to process new visa files
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
            // 🟢 Ensures the target applicant profile exists in your applicants table
            "applicant_id" => ["required", "integer", "exists:visa_applicants,applicant_id"],

            // 🟢 Validates that the selected visa type matches real embassy processing categories
            "visa_type" => ["required", "string", "in:Tourist,Business,Student,Work"],

            // 🟢 Enforces checking the current processing status milestone
            "application_status" => ["required", "string", "in:Pending,Approved,Rejected"],
        ];
    }
}
