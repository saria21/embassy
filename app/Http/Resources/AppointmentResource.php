<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "appointment_id" => $this->appointment_id,
            
            // 🟢 ChatGPT Fix: Exposes the full relational data IDs to the API client response
            "applicant_id" => $this->applicant_id,
            "citizen_id" => $this->citizen_id,
            
            "interviewer_staff_id" => $this->interviewer_staff_id,
            "purpose_of_visit" => $this->purpose_of_visit,
            "appointment_date" => $this->appointment_date,
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
