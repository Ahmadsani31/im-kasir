<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MejaResource extends JsonResource
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
            'meja_id' => $this->meja_id,
            'nama' => $this->nama,
            'jenis' => $this->jenis == 'STD' ? 'Standar' : 'VVIP',
            'harga' => $this->harga,
            'gambar' => Storage::url($this->gambar),
            'created_at' => formatDate($this->created_at),
        ];
    }
}
