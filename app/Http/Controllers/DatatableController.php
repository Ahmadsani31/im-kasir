<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    public function index(Request $request)
    {
        $data = Produk::select('*');

        if ($request->kat) {
            $data->where('katagori_id', $request->kat);
        }

        return DataTables::of($data)->addIndexColumn()
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('harga', function ($row) {
                return 'Rp.' . number_format($row->harga_jual);
            })
            ->editColumn('gambar', function ($row) {
                return '<img src="' . Storage::url($row->gambar) . '" width="100" alt="alt-produk">';
            })
            ->editColumn('stock', function ($row) {
                return  $row->stock;
            })
            ->addColumn('tanggal', function ($row) {
                return formatDate($row->created_at);
            })->rawColumns(['gambar', 'tanggal', 'harga'])
            ->toJson();
    }
}
