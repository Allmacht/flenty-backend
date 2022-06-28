<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
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
            'key'        => $this->key,
            'summary'    => $this->summary,
            'status'     => $this->status,
            'description'=> $this->description,
            'assignee'   => new UserResource($this->whenLoaded('assignee')),
            'reporter'   => new UserResource($this->whenLoaded('reporter')),
            'priority'   => new PriorityResource($this->whenLoaded('priority')),
            'issue_type' => new IssueTypeResource($this->whenLoaded('issue_type')),
            'project'    => new ProjectResource($this->whenLoaded('project')),
            'files'      => AttachedFileResource::collection($this->whenLoaded('files')),
            'created_at' => $this->created_at->format('d/m/Y H:i:s'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
