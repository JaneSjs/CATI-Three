<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            // 'id' => $this->id,
            // 'user_id' => $this->user_id,
            // 'project_id' => $this->project_id,
            // 'survey_name' => $this->survey_name,
            'content' => $this->content,
            //'version' => $this->stage,
        ];
    }
}
