<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataPelajaranController extends Controller
{
    // Menampilkan halaman utama dengan DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MataPelajaran::select(['id', 'nama']);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('backend.matapelajaran.action', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.matapelajaran.index');
    }

    // Menampilkan form tambah mata pelajaran
    public function create()
    {
        return view('backend.matapelajaran.create');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        MataPelajaran::create(['nama' => $request->nama]);

        return redirect()->route('mata_pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    // Menampilkan halaman edit mata pelajaran
    public function edit($id)
    {
        $matapelajaran = MataPelajaran::findOrFail($id);
        return view('backend.matapelajaran.edit', compact('matapelajaran'));
    }

    // Memperbarui data mata pelajaran di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $matapelajaran = MataPelajaran::findOrFail($id);
        $matapelajaran->update(['nama' => $request->nama]);

        return redirect()->route('mata_pelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui!');
    }

    // Menghapus data mata pelajaran dari database
    public function destroy($id)
    {
        $matapelajaran = MataPelajaran::find($id);

        if (!$matapelajaran) {
            return response()->json(['error' => 'Mata Pelajaran tidak ditemukan!'], 404);
        }

        $matapelajaran->delete();

        return response()->json(['success' => 'Mata Pelajaran berhasil dihapus!']);
    }
}
