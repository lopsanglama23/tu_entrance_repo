<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'citizenship_no' => $this->citizenship_no,
            'citizenship_copy' => $this->citizen_copy_url,
            'district' => $this->district,
            'permanent_address' => $this->permanent_address,
            'contact_address' => $this->contact_address,
            'contact_landline' => $this->contact_landline,
            'contact_phone' => $this->contact_phone,
            'user_id' => $this->user_id,
        ];
    }
}
