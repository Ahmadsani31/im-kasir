<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class KatagoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'katagori_id' => $this->katagori_id,
            'nama' => $this->nama,
            'gambar' => Storage::url($this->gambar),
            'created_at' => formatDate($this->created_at),
        ];
    }
}
