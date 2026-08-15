<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisaApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique internal database primary key for the application record
            "application_id" => $this->application_id,

            // 🟢 Maps the foreign key linking this file directly to a specific applicant profile
            "applicant_id" => $this->applicant_id,

            // 🟢 Formats the assigned application type category (e.g. Tourist, Business, Student, Work)
            "visa_type" => $this->visa_type,

            // 🟢 Captures the current processing milestone status (e.g. Pending, Approved, Rejected)
            "application_status" => $this->application_status,

            // 🟢 Converts the database creation timestamp into a clean, human-readable date string
            "created_at" => $this->created_at?->toDateTimeString(),

            // 🟢 Converts the final modification timestamp into a clean, human-readable date string
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
