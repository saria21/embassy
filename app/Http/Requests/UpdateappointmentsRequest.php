<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateappointmentsRequest extends FormRequest
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
            // 🟢 Swaps "required" for "sometimes" to allow flexible, partial data modifications
            "interviewer_staff_id" => ["sometimes", "integer", "exists:staff,staff_id"],

            // 🟢 Makes the operational reason optional during modifications
            "purpose_of_visit" => ["sometimes", "string", "in:Visa Interview,Passport Renewal,Document Attestation,Notary Services"],

            // 🟢 Makes the calendar entry date field optional during a reschedule
            "appointment_date" => ["sometimes", "date"],
        ];
    }
}

