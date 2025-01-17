<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Resources\PublisherResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'total'         => $this->total,
            'book'          => new BookResource($this->book),
            'publisher'     => new PublisherResource($this->publisher),
            'created_at'    => Carbon::parse($this->created_at)->translatedFormat('d F Y H:i:s'),
            'updated_at'    => Carbon::parse($this->updated_at)->translatedFormat('d F Y H:i:s'),
        ];
    }
}
