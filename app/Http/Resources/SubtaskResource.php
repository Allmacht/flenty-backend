<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubtaskResource extends JsonResource
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
            'id'         => $this->id,
            'subtask'    => $this->subtask,
            'value'      => $this->value,
            'completed'  => $this->completed ?: false,
            'created_at' => $this->created_at->format('M d, Y h:i A'),
            'issue'      => new IssueResource($this->whenLoaded('issue')),
        ];
    }
}
