<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachedFileResource extends JsonResource
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
            'file'       => $this->file,
            'name'       => $this->original_name.'.'.$this->extension,
            'editable'   => $this->editable,
            'created_at' => $this->created_at->format('M d, Y H:i:s'),
            'issue'      => new IssueResource($this->whenLoaded('issue'))
        ];
    }
}
