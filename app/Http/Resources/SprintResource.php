<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SprintResource extends JsonResource
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
            'id'                 => $this->id,
            'key'                => $this->key,
            'name'               => $this->name,
            'goal'               => $this->goal,
            'initial_date'       => Carbon::parse($this->initial_date)->format('M d, Y'),
            'projected_end_date' => Carbon::parse($this->projected_end_date)->format('M d, Y'),
            'project'            => new ProjectResource($this->whenLoaded('project')),
            'workflows'          => WorkflowResource::collection($this->whenLoaded('workflows')),
            'diff_days'          => today()->diffInDays(Carbon::parse($this->projected_end_date)),
            'out_of_date'        => today()->greaterThan(Carbon::parse($this->projected_end_date)),
            'created_at'         => $this->created_at->format('M d, Y h:i A'),
            'updated_at'         => $this->updated_at->format('M d, Y h:i A'), 
        ];
    }
}
