<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
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
            'transaksi_id' => $this->transaksi_id,
            'transaksi_uuid' => $this->transaksi_uuid,
            'invoice' => $this->invoice,
            'cashier_nama' => $this->cashier_nama,
            'costumer_nama' => $this->costumer_nama,
            'sub_harga' => number_format($this->sub_harga),
            'pajak' => number_format($this->pajak),
            'total_harga' => number_format($this->total_harga),
            'kembalian' => number_format($this->kembalian),
            'bayar' => number_format($this->bayar),
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
