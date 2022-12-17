<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PositionResource extends JsonResource
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
            'title' => $this->title,
            'admin_created_id' => $this->admin_created_id,
            'admin_updated_id' => $this->admin_updated_id,
            'created_at' => Carbon::create( $this->created_at,)->format('d.m.Y'),
            'updated_at' => Carbon::create($this->updated_at)->format('d.m.Y'),
        ];
    }
}
