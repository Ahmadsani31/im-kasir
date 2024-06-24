<?php

namespace App\Http\Controllers;

use App\Http\Resources\MejaResource;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class MejaController extends Controller
{
    public function index()
    {
        return Inertia::render('Meja/Index', [
            'meja' => MejaResource::collection(Meja::all())
        ]);
    }

    public function create()
    {
        return Inertia::render('Meja/Create', [
            'meja' => []
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'gambar' => [
                'required',
                File::image()
                    ->max('5mb')
            ]
        ]);

        $dataInsert = [
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jenis' => $request->jenis,
        ];

        if ($request->hasFile('gambar')) {

            $filePath = Storage::disk('public')->put('files/meja', request()->file('gambar'));
            $dataInsert['gambar'] = $filePath;
        }

        Meja::create($dataInsert);

        return redirect()->route('meja')->with('message', 'Meja Created Successfully');
    }

    public function edit(Meja $meja)
    {
        return Inertia::render('Meja/Create', [
            'meja' => $meja,
            'gambar' => Storage::url($meja->gambar),
        ]);
    }
}
