<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\MataPelajaran;
use App\Models\Nilai;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah data dari database
        $students = Student::count();
        $teachers = Teacher::count();
        $matapelajaran = MataPelajaran::count();

        // Hitung jumlah siswa berdasarkan kategori nilai
        $nilaiRanks = [
        'A' => Nilai::whereBetween('nilai', [85, 100])->count(),
        'B' => Nilai::whereBetween('nilai', [70, 84])->count(),
        'C' => Nilai::whereBetween('nilai', [55, 69])->count(),
        'D' => Nilai::whereBetween('nilai', [40, 54])->count(),
        'E' => Nilai::whereBetween('nilai', [0, 39])->count(),
        ];

        // Kirim data dalam bentuk JSON untuk AJAX
        $chartData = [
            'students' => $students,
            'teachers' => $teachers,
            'matapelajaran' => $matapelajaran
        ];

        return view('backend.dashboard.index', compact('students', 'teachers', 'matapelajaran', 'nilaiRanks', 'chartData'));
    }
}
