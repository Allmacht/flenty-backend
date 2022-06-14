<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            $this->mergeWhen($request->input('full_data'), [
                'business_name' => $this->business_name,
                'slug' => $this->slug,
                'email' => $this->email,
                'phone' => $this->phone,
                'company' => new CompanyResource($this->whenLoaded('company'))
            ])
        ];
    }
}
