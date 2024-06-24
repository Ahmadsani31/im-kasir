<?php

namespace App\Http\Resources;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $produk = Produk::find($this->produk_id);
        return [
            'cart_id' => $this->cart_id,
            'meja_id' => $this->meja_id,
            'nama_produk' =>  $produk->nama,
            'gambar' => Storage::url($produk->gambar),
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
            'created_at' => formatDate($this->created_at),
        ];
    }
}
