<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'user' => new User($this->whenLoaded('createdByUser')),
                'course' => new Course($this->whenLoaded('course'))
            ]
        );
    }
}
