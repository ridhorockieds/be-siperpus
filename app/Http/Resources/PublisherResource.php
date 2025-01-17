<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('d F Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('d F Y H:i:s'),
        ];
    }
}
