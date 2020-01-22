<?php

declare(strict_types=1);

namespace App\Http\Resources;

// Framework
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'priority' => $this->priority,
            'due_in' => $this->due_in,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
