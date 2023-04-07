<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;
use Throwable;

class BarangController extends Controller
{
    public function index() {
        $data = Barang::latest()->paginate(5);
        return new BarangResource(200,'berhasil', $data);
    }

    public function show(Barang $barang) {
        try {
            return new BarangResource(200, "ditemukan" , $barang);
        } catch (Throwable $e) {
            return response()->json(["error" => $e->getMessage()],500);
        } 
    }

    public function store(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
            ]);

            $validatedData = Barang::create($data);
            return new BarangResource(200,'Berhasil ditambahkan',$validatedData);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Barang $barang)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
            ]);
            $barang->update($data);
            return new BarangResource(200,'Berhasil di update',$barang);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return new BarangResource(true, 'berhasil dihapus!',null);
    }
}
