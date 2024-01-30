<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge(
            parent::toArray($request),
            [
                'user' => new User($this->whenLoaded('createdByUser')),
                'events' => new User($this->whenLoaded('events'))
            ]
        );
    }
}
