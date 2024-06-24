<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\MejaResource;
use App\Http\Resources\ProdukResources;
use App\Models\Cart;
use App\Models\Meja;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        $query = Meja::query();

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        return Inertia::render('Transaksi/Index', [
            'meja' => MejaResource::collection($query->get()),
            'jenis' => ''
        ]);
    }

    public function pesanan($id)
    {
        $hargaMeja = 0;
        $meja =  Meja::findOrFail($id);
        if ($meja) {
            $hargaMeja = $meja->harga;
        }

        $cart =   CartResource::collection(Cart::where('cashier_id', Auth::user()->id)->get());
        $harga = 0;
        $pesanan = 0;
        foreach ($cart as $va) {
            $pesanan = $pesanan + $va->jumlah;
            $harga += $va->harga * $va->jumlah;
        }

        $pajak = $harga * (11 / 100);
        $TotalHarga = $harga + $pajak;

        return Inertia::render('Transaksi/Pesanan', [
            'meja' => new MejaResource($meja),
            'produk' => ProdukResources::collection(Produk::all()),
            'cart' => CartResource::collection(Cart::where('cashier_id', Auth::user()->id)->get()),
            'harga' => $harga,
            'harga_meja' => $hargaMeja,
            'pajak' => $pajak,
            'total' => $TotalHarga,
            'pesanan' => $pesanan,
            'invoice' => 'INV-' . date('Ymd') . Str::upper(Str::random(5))
        ]);
    }

    public function cart(Request $request)
    {

        $request->validate([
            'produk_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        $cart = Cart::where('produk_id', $request->produk_id)->where('cashier_id', Auth::user()->id)->first();

        if ($cart) {
            $jumlah = $cart->jumlah;
            $cart->jumlah = $request->jumlah + $jumlah;
            $cart->save();
        } else {

            Cart::create([
                'cashier_id' => Auth::user()->id,
                'produk_id' =>  $request->produk_id,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
            ]);
        }

        return redirect()->back();
        // return redirect()->route('transaksi.pesanan', $request->meja_id)->with('message', 'Cart Created Successfully');
    }
}
