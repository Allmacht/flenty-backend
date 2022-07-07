<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class ProjectResource extends JsonResource
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
            'id'     => $this->uuid,
            'key'    => $this->key,
            'name'   => $this->name,
            'image'  => $this->image,
            'slug'   => $this->slug,
            'status' => $this->status,
            'type'   => new ProjectTypeResource($this->whenLoaded('projectType')),
            $this->mergeWhen($request->input('all_data'), [
                'description'        => $this->description,
                'initial_date'       => Carbon::parse($this->initial_date)->format('M d, Y'),
                'projected_end_date' => Carbon::parse($this->projected_end_date)->format('M d, Y'),
                'diff_days'          => today()->diffInDays(Carbon::parse($this->projected_end_date)),
                'out_of_date'        => today()->greaterThan(Carbon::parse($this->projected_end_date)),
                'end_date'           => $this->end_date?->format('Y-m-d H:i:s'),
                'public'             => $this->public,
                'approved'           => $this->approved,
            ])
        ];
    }
}
