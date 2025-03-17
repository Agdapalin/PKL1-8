<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // Menampilkan daftar nilai dengan fitur pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $nilai = Nilai::with(['student', 'teacher', 'mapel'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('teacher', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('mapel', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('backend.nilai.index', compact('nilai'));
    }

    // Menampilkan form tambah nilai
    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $mapel = MataPelajaran::all();
        return view('backend.nilai.create', compact('students', 'teachers', 'mapel'));
    }

    // Menyimpan data nilai baru
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id',
            'mapel_id' => 'required|exists:matapelajaran,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Nilai::create($request->all());

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    // Menampilkan form edit nilai
    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $students = Student::all();
        $teachers = Teacher::all();
        $mapel = MataPelajaran::all();
        return view('backend.nilai.edit', compact('nilai', 'students', 'teachers', 'mapel'));
    }

    // Mengupdate data nilai
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id',
            'mapel_id' => 'required|exists:matapelajaran,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    // Menghapus data nilai
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus');
    }
}
