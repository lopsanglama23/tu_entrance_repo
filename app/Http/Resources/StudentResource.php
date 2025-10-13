<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'first_name_dev' => $this->first_name_dev,
            'middle_name_dev' => $this->middle_name_dev,
            'last_name_dev' => $this->last_name_dev,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'date_of_birth_bs' => $this->date_of_birth_bs,
            'date_of_birth_ad' => $this->date_of_birth_ad,
            'student_photo' => $this->student_photo_url,
            'student_signature' => $this->student_signature_url,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
  
}
