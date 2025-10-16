<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'photo' => url('storage/' . $this->photo),
            // 'sign' => url('storage/' . $this->sign),
            // 'citizen' => url('storage/' . $this->citizen),
            'photo' =>$this->photo_url,
            'sign' => $this->sign_url,
            'citizen' => $this->citizen_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
