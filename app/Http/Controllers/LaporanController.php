<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransaksiResource;
use App\Models\Meja;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiMejaDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return Inertia::render('Laporan/Index', [
            'transaksi' => TransaksiResource::collection($transaksi),
        ]);
    }

    public function transaksi(Request $request)
    {
        $transaksi =  Transaksi::where('transaksi_uuid', $request->transaksiuuid)->first();
        if ($transaksi) {

            $invoice = $transaksi->invoice;
            $cashier_nama = $transaksi->cashier_nama;
            $costumer_nama = $transaksi->costumer_nama;
            $sub_harga = $transaksi->sub_harga;
            $pajak = $transaksi->pajak;
            $total_harga = $transaksi->total_harga;
            $bayar = $transaksi->bayar;
            $kembalian = $transaksi->kembalian;
            $metode_bayar = $transaksi->metode_bayar;
            $transaksi_uuid = $transaksi->transaksi_uuid;
            $created_at = Carbon::parse($transaksi->created_at)->format('Y-m-d');

            $transaksiDetail =   TransaksiDetail::where('transaksi_id', $transaksi->transaksi_id)->get();
            $totalMakanan = 0;
            foreach ($transaksiDetail as $vaDetail) {
                $totalMakanan +=  $totalMakanan + $vaDetail->jumlah;
                $produk = Produk::find($vaDetail->produk_id);
                $makanan[] = [
                    'gambar' => Storage::url($produk->gambar),
                    'nama' => $produk->nama,
                    'harga' => $vaDetail->harga,
                    'jumlah' => $vaDetail->jumlah,
                    'total_harga' => $vaDetail->total_harga,
                ];
            }

            $transaksiMeja = TransaksiMejaDetail::where('transaksi_id', $transaksi->transaksi_id)->get();
            foreach ($transaksiMeja as $vameja) {
                $meja = Meja::find($vameja->meja_id);
                $dataMeja[] = [
                    'gambar' => Storage::url($produk->gambar),
                    'nama' => $meja->nama,
                    'harga' => $vameja->harga,
                    'durasi' => $vameja->durasi,
                    'total_harga' => $vameja->total_harga,
                ];
            }

            switch ($metode_bayar) {
                case 'Cash':
                    $metode = 'Cash';
                    break;
                case 'Credit':
                    $metode = 'Kartu Kredit';
                    break;
                case 'Debit':
                    $metode = 'Kartu Debit';
                    break;
                case 'Gopay':
                    $metode = 'Gopay';
                    break;
                case 'Qris':
                    $metode = 'Qris';
                    break;
                default:
                    $metode = '';
                    break;
            }

            return response()->json([
                'status' => true,
                'message' => 'successfull',
                'items' => [
                    'makanan' => $makanan,
                    'dataMeja' => $dataMeja,
                    'invoice' => $invoice,
                    'cashier_nama' => $cashier_nama,
                    'costumer_nama' => $costumer_nama,
                    'sub_harga' => $sub_harga,
                    'pajak' => $pajak,
                    'bayar' => $bayar,
                    'total_harga' => $total_harga,
                    'totalMakanan' => $totalMakanan,
                    'kembalian' => $kembalian,
                    'tanggal' => $created_at,
                    'metode_bayar' => $metode,
                    'transaksi_uuid' => $transaksi_uuid,
                ]
            ]);
        }
    }
}
