<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $teachers = DB::table('teacher')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(3);

        return view('backend.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('backend.teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teacher',
            'phone' => 'nullable|string|max:20',
            'jabatan' => 'required|string|max:100',
            'addres' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $request->hasFile('photo') 
            ? $request->file('photo')->store('teacher', 'public') 
            : null;

        DB::table('teacher')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jabatan' => $request->jabatan,
            'addres' => $request->addres,
            'gender' => $request->gender,
            'photo' => $photoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('teacher')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teacher = DB::table('teacher')->where('id', $id)->first();
        if (!$teacher) {
            return redirect()->route('teacher')->with('error', 'Data guru tidak ditemukan.');
        }
        return view('backend.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teacher,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'jabatan' => 'required|string|max:100',
            'addres' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $teacher = DB::table('teacher')->where('id', $id)->first();
        if (!$teacher) {
            return redirect()->route('teacher')->with('error', 'Data guru tidak ditemukan.');
        }

        $photoPath = $teacher->photo;
        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $photoPath = $request->file('photo')->store('teacher', 'public');
        }

        DB::table('teacher')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jabatan' => $request->jabatan,
            'addres' => $request->addres,
            'gender' => $request->gender,
            'photo' => $photoPath,
            'updated_at' => now(),
        ]);

        return redirect()->route('teacher')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $teacher = DB::table('teacher')->where('id', $id)->first();
        if (!$teacher) {
            return redirect()->route('teacher')->with('error', 'Data guru tidak ditemukan.');
        }

        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        DB::table('teacher')->where('id', $id)->delete();

        return redirect()->route('teacher')->with('success', 'Data guru berhasil dihapus.');
    }
}
