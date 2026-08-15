<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Updatevisa_applicationsRequest extends FormRequest
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
            // 🟢 Optional during updates
            "applicant_id" => ["sometimes", "integer", "exists:visa_applicants,applicant_id"],

            // 🟢 Optional during updates
            "visa_type" => ["sometimes", "string", "in:Tourist,Business,Student,Work"],

            // 🟢 Often used when changing an operational milestone from Pending to Approved!
            "application_status" => ["sometimes", "string", "in:Pending,Approved,Rejected"],
        ];
    }
}
