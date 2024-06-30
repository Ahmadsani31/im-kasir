<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\MejaResource;
use App\Http\Resources\ProdukResources;
use App\Models\Cart;
use App\Models\Meja;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiMejaDetail;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        $jenis = $request->jenis;
        $jam = $request->jam;

        $meja = DB::table('meja')
            ->when($jenis, function (Builder $query, string $jenis) {
                $query->where('jenis', $jenis);
            })->get();

        $curDate = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($meja as $va) {
            $trx_meja = TransaksiMejaDetail::where('meja_id', $va->meja_id)
                ->where('jam_mulai', '<=', $curDate)->where('jam_selesai', '>=', $curDate)->get();
            if ($trx_meja->count() > 0) {
                $stt = false;
            } else {
                $stt = true;
            }

            $data[] = [
                'meja_id' => $va->meja_id,
                'nama' => $va->nama,
                'jenis' => $va->jenis == 'STD' ? 'Standar' : 'VVIP',
                'harga' => $va->harga,
                'gambar' => Storage::url($va->gambar),
                'created_at' => formatDate($va->created_at),
                'status' => $stt,
            ];
        }

        return Inertia::render('Transaksi/Index', [
            'meja' => $data,
            'jenis' => $jenis,
            'jam' => $jam
        ]);
    }

    public function pesanan($id)
    {
        $meja =  Meja::findOrFail($id);

        return Inertia::render('Transaksi/Pesanan', [
            'meja' => new MejaResource($meja),
            'produk' => ProdukResources::collection(Produk::all()),
            'cart' => CartResource::collection(Cart::where('cashier_id', Auth::user()->id)->get()),
            'invoice' => 'INV-' . Str::upper(Str::random(5)) . time(),
            'meja_id' => $id
        ]);
    }

    public function save(Request $request)
    {

        $curDate = Carbon::now()->format('Y-m-d H:i:s');
        $trx_meja = TransaksiMejaDetail::where('meja_id', $request->meja_id)
            ->where('jam_mulai', '<=', $curDate)->where('jam_selesai', '>=', $curDate)->get();
        if ($trx_meja->count() > 0) {
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Pesanan tidak bisa di proses, meja lagi di gunakan.',
                'item' => []
            ]);
        }

        $cart = Cart::where('cashier_id', Auth::user()->id)->get();
        $jumlah = 0;
        $harga = 0;
        foreach ($cart as $va) {
            $jumlah += $va->jumlah;
            $harga += $va->harga * $va->jumlah;
            $dataCart[] = $va;
        }


        $meja =  Meja::findOrFail($request->meja_id);

        $hargaMeja = $meja->harga * $request->jam;

        $subHarga = $harga + $hargaMeja;
        $pajak = $subHarga * 0.11;

        $totalHarga = $subHarga + $pajak;

        $kembalian = $request->bayar - $totalHarga;


        try {
            DB::beginTransaction();

            $transaksi =  Transaksi::create([
                'user_id' => Auth::user()->id,
                'transaksi_uuid' => Str::uuid(),
                'invoice' => $request->invoice,
                'cashier_nama' => Auth::user()->name,
                'costumer_nama' => $request->costumer,
                'sub_harga' => $subHarga,
                'pajak' => $pajak,
                'total_harga' => $totalHarga,
                'bayar' => $request->bayar,
                'kembalian' => $kembalian,
                'metode_bayar' => $request->metode_bayar,
                'diskon' => 0,
            ]);

            $lastInsertedId = $transaksi->transaksi_id;
            $transaksiUuid = $transaksi->transaksi_uuid;

            foreach ($dataCart as $vaCart) {

                $tHrg = $vaCart->harga * $vaCart->jumlah;

                TransaksiDetail::create([
                    'transaksi_id' => $lastInsertedId,
                    'produk_id' => $vaCart->produk_id,
                    'harga' => $vaCart->harga,
                    'jumlah' => $vaCart->jumlah,
                    'total_harga' => $tHrg,
                ]);
            }

            $current = Carbon::now();

            $jam_mulai = $current->format('Y-m-d H:i:s');
            $jam_selesai = $current->addHour($request->jam)->format('Y-m-d H:i:s');



            TransaksiMejaDetail::create([
                'transaksi_id' => $lastInsertedId,
                'meja_id' => $meja->meja_id,
                'harga' => $meja->harga,
                'durasi' => $request->jam,
                'total_harga' => $hargaMeja,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'lampu' => '1',
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with([
                'status' => false,
                'message' => $th->getMessage(),
                'items' => []
            ]);
            exit();
        }

        Cart::where('cashier_id', Auth::user()->id)->delete();

        return redirect()->back()->with([
            'status' => true,
            'message' => 'successfull',
            'items' => [
                'uuid' => $transaksiUuid
            ]
        ]);

        // return redirect()->back();
        // return redirect()->route('transaksi.pesanan', $request->meja_id)->with('message', 'Cart Created Successfully');
    }

    public function destroyAllCart()
    {
        Cart::where('cashier_id', Auth::user()->id)->delete();
        // return redirect()->route('transaksi');
    }

    public function print($invoice)
    {

        $transaksi =  Transaksi::where('transaksi_uuid', $invoice)->first();
        if ($transaksi) {

            $invoice = $transaksi->invoice;
            $cashier_nama = $transaksi->cashier_nama;
            $costumer_nama = $transaksi->costumer_nama;
            $sub_harga = $transaksi->sub_harga;
            $pajak = $transaksi->pajak;
            $total_harga = $transaksi->total_harga;
            $bayar = $transaksi->bayar;
            $kembalian = $transaksi->kembalian;

            $transaksiDetail =   TransaksiDetail::where('transaksi_id', $transaksi->transaksi_id)->get();
            foreach ($transaksiDetail as $vaDetail) {
                $produk = Produk::find($vaDetail->produk_id);
                $makanan[] = [
                    'nama' => $produk->nama,
                    'harga' => $vaDetail->harga,
                    'jumlah' => $vaDetail->jumlah,
                ];
            }

            $transaksiMeja = TransaksiMejaDetail::where('transaksi_id', $transaksi->transaksi_id)->get();
            foreach ($transaksiMeja as $vameja) {
                $meja = Meja::find($vameja->meja_id);
                $dataMeja[] = [
                    'nama' => $meja->nama,
                    'harga' => $vameja->harga,
                    'durasi' => $vameja->durasi,
                ];
            }
            return Inertia::render('Transaksi/Print', [
                'makanan' => $makanan,
                'dataMeja' => $dataMeja,
                'invoice' => $invoice,
                'cashier_nama' => $cashier_nama,
                'costumer_nama' => $costumer_nama,
                'sub_harga' => $sub_harga,
                'pajak' => $pajak,
                'bayar' => $bayar,
                'total_harga' => $total_harga,
                'kembalian' => $kembalian,
            ]);
        }
    }
}
