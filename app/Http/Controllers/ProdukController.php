<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukResources;
use App\Models\Katagori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Produk/Index', [
            'katagori' => Katagori::all()
        ]);
        // return Inertia::render('Produk/Index', [
        //     'produk' => Produk::query()->when($request->search, function ($query, $search) {
        //         $query->where('nama', 'like', "%{$search}%");
        //     })->paginate(5),
        //     'filters' => $request->only(['search'])
        // ]);
    }

    public function getProduk(Request $request)
    {

        $query = Produk::query();



        return response()->json([
            'status' => true,
            'message' => 'successfull',
            'item' => new ProdukResources(Produk::findOrFail($request->id))
        ]);
    }


    public function create()
    {
        return Inertia::render('Produk/Create', [
            'produk' => [],
            'katagori' => Katagori::all(),
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'katagori_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $produkInsert = [
            'user_id' => Auth::user()->id,
            'katagori_id' =>  $request->katagori_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_jual' => $request->harga_jual,
            'stock' => $request->stock,
            'keterangan' => $request->keterangan,
            'user_at' => Auth::user()->name
        ];

        if ($request->hasFile('gambar')) {

            $request->validate([
                'gambar' => [
                    'required',
                    File::image()
                        ->max('1mb')
                ]
            ]);

            $filePath = Storage::disk('public')->put('files/produk', request()->file('gambar'));
            $produkInsert['gambar'] = $filePath;
        }

        Produk::create($produkInsert);

        return redirect()->route('produk')->with('message', 'Produk Created Successfully');
    }

    public function edit(Produk $produk)
    {
        return Inertia::render('Produk/Create', [
            'produk' => $produk,
            'katagori' => Katagori::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        Storage::delete('files/produk' . $produk->photo);
        $produk->delete();
        // return redirect()->back();
    }
}
