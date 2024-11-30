<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'phone_number' => $this->phone_number,
            'description' => $this->description
        ];
    }
}
