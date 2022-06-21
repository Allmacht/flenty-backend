<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            $this->mergeWhen($request->input('all_data'), [
                'description'        => $this->description,
                'initial_date'       => $this->initial_date->format('Y-m-d H:i:s'),
                'projected_end_date' => $this->projected_end_date->format('Y-m-d H:i:s'),
                'end_date'           => $this->end_date->format('Y-m-d H:i:s'),
                'public'             => $this->public,
                'approved'           => $this->approved,
            ])
        ];
    }
}
