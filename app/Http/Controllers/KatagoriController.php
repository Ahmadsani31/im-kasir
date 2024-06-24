<?php

namespace App\Http\Controllers;

use App\Http\Resources\KatagoriResource;
use App\Models\Katagori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class KatagoriController extends Controller
{
    public function index()
    {
        // return Inertia::render('Katagori/Index', [
        //     'katagori' => Katagori::paginate(5)->through(
        //         function ($item) {
        //             return [
        //                 'katagori_id' => $item->katagori_id,
        //                 'nama' => $item->nama,
        //                 'gambar' => Storage::url($item->gambar),
        //                 'created_at' => formatDate($item->created_at),
        //             ];
        //         }
        //     )->withQueryString()
        // ]);
        return Inertia::render('Katagori/Index', [
            'katagori' => KatagoriResource::collection(Katagori::all())
        ]);
    }

    public function create()
    {
        return Inertia::render('Katagori/Create', [
            'katagori' => []
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $dataInsert = [
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
        ];

        if ($request->hasFile('gambar')) {

            $request->validate([
                'gambar' => [
                    'required',
                    File::image()
                        ->max('5mb')
                ]
            ]);

            $filePath = Storage::disk('public')->put('files/katagori', request()->file('gambar'));
            $dataInsert['gambar'] = $filePath;
        }

        Katagori::create($dataInsert);

        return redirect()->route('katagori')->with('message', 'Produk Created Successfully');
    }

    public function edit(Katagori $katagori)
    {
        return Inertia::render('Katagori/Create', [
            'katagori' => $katagori,
            'gambar' => Storage::url($katagori->gambar),
        ]);
    }
}
