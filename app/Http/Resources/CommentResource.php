<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment'    => $this->comment,
            'edit'       => false,
            'edited'     => $this->edited,
            'user'       => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at->format('M d, Y h:i A')
        ];
    }
}
