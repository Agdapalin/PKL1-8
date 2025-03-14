<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = DB::table('students')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->orWhere('phone', 'like', "%$search%");
            })
            ->paginate(10);

        return view('backend.student.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student.create');
    }

    public function store(StoreStudentRequest $request)
    {
        // Upload gambar jika ada
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('students', 'public') 
            : null;

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

    public function update(StoreStudentRequest $request, $id)
    {
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
        $student = DB::table('students')->where('id', $id)->first();
        if (!$student) {
            return redirect()->route('student')->with('error', 'Data siswa tidak ditemukan.');
        }

        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        DB::table('students')->where('id', $id)->delete();

        return redirect()->route('student')->with('success', 'Data siswa berhasil dihapus.');
    }
}
