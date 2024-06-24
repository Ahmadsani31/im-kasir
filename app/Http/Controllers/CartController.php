<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function Increase(Request $request)
    {

        $cart =    Cart::findOrfail($request->cart_id);
        if ($cart) {
            $jumlah = $cart->jumlah;
            $cart->jumlah = $jumlah + 1;
            $cart->save();
        }
    }

    public function Decrease(Request $request)
    {
        $cart =    Cart::findOrfail($request->cart_id);
        if ($cart) {
            $jumlah = $cart->jumlah;
            if ($jumlah == 1) {
                $cart->delete();
            } else {
                $cart->jumlah = $jumlah - 1;
                $cart->save();
            }
        }
    }

    public function addToCart(Request $request)
    {

        $cart = Cart::where('produk_id', $request->produk_id)->where('cashier_id', Auth::user()->id)->first();

        if ($cart) {
            $jumlah = $cart->jumlah;
            $cart->jumlah = 1 + $jumlah;
            $cart->save();
        } else {
            $produk = Produk::findOrFail($request->produk_id);
            Cart::create([
                'cashier_id' => Auth::user()->id,
                'produk_id' =>  $request->produk_id,
                'jumlah' => 1,
                'harga' => $produk->harga,
            ]);
        }

        return redirect()->back()->with('message', 'Produk Berhasil Ditambahkan');
    }

    public function destroyCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }

    public function destroyAllCart()
    {
        Cart::where('cashier_id', Auth::user()->id)->delete();
        return redirect()->back();
    }
}
