<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitizenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique system identification index for this citizen profile
            "citizen_id" => $this->citizen_id,

            // 🟢 Formats the official tracked passport identification serial sequence
            "passport_number" => $this->passport_number,

            // 🟢 Displays the full legal name parameter of the individual
            "full_name" => $this->full_name,

            // 🟢 Captures the current registered residential address log inside the database
            "current_address" => $this->current_address,

            // 🟢 Standard database tracking metrics for history auditing logs
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
