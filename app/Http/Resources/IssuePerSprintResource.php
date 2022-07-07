<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssuePerSprintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sprint'   => new SprintResource($this->whenLoaded('sprint')),
            'workflow' => new WorkflowResource($this->whenLoaded('workflow'))
        ];
    }
}
