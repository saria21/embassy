<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique primary key for the structural embassy department
            "department_id" => $this->department_id,

            // 🟢 Exposes the foreign key linking this sector to a physical facility anchor
            "building_id" => $this->building_id,

            // 🟢 Displays the official division title (e.g. Visa Section, Consular Affairs)
            "department_name" => $this->department_name,

            // 🟢 Standard database tracking logs formatted into clear datetime segments
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
