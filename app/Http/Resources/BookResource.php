<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'price' => 'Rp.' . number_format($this->price, 0, ',', '.'),
            'stock' => $this->stock,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('d F Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('d F Y H:i:s'),
        ];
    }
}
