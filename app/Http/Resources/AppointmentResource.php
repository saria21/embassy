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
            // 🟢 Maps the unique database reservation ID for this booking
            "appointment_id" => $this->appointment_id,

            // 🟢 Maps the security staff member responsible for conducting the screening
            "interviewer_staff_id" => $this->interviewer_staff_id,

            // 🟢 Formats the official reason for the embassy visit (e.g. Visa Interview, Passport Renewal)
            "purpose_of_visit" => $this->purpose_of_visit,

            // 🟢 Displays the locked calendar date for the booking
            "appointment_date" => $this->appointment_date,

            // 🟢 Standard database creation and update history logs
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
