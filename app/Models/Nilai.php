<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = ['student_id', 'teacher_id', 'mapel_id', 'nilai'];

    // Relasi ke Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi ke Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relasi ke Mapel (Mata Pelajaran)
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}

