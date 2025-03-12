<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(5); // Ambil 5 data per halaman
        return view('backend.students.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string|max:20',
            'class' => 'required|string|max:100',
            'addres' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
        }

        DB::table('students')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'class' => $request->class,
            'addres' => $request->addres,
            'gender' => $request->gender,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('student')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $student = DB::table('students')->where('id', $id)->first();
        if (!$student) {
            return redirect()->route('student')->with('error', 'Data siswa tidak ditemukan.');
        }
        return view('backend.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'class' => 'required|string|max:100',
            'addres' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = DB::table('students')->where('id', $id)->first();
        if (!$student) {
            return redirect()->route('student')->with('error', 'Data siswa tidak ditemukan.');
        }

        $imagePath = $student->image;
        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $imagePath = $request->file('image')->store('students', 'public');
        }

        DB::table('students')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'class' => $request->class,
            'addres' => $request->addres,
            'gender' => $request->gender,
            'image' => $imagePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('student')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data siswa berdasarkan ID
        $student = DB::table('students')->where('id', $id)->first();

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$student) {
            return redirect()->route('student')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Hapus gambar jika ada
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        // Hapus data siswa dari database
        DB::table('students')->where('id', $id)->delete();

        return redirect()->route('student')->with('success', 'Data siswa berhasil dihapus.');
    }
}
