<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProdukResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'produk_id' => $this->produk_id,
            'nama' => $this->nama,
            'harga' => $this->harga_jual,
            'stock' => $this->stock,
            'gambar' => Storage::url($this->gambar),
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
