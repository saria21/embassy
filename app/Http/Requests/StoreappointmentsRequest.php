<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
class StoreappointmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API to accept incoming appointment data
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
            // 🟢 Ensures the staff member field is provided and exists in your staff table
            "interviewer_staff_id" => ["required", "integer", "exists:staff,staff_id"],

            // 🟢 Validates that the appointment reason matches official embassy tasks
            "purpose_of_visit" => ["required", "string", "in:Visa Interview,Passport Renewal,Document Attestation,Notary Services"],

            // 🟢 Ensures a proper calendar date is provided
            "appointment_date" => ["required", "date"],
        ];
    }
}
