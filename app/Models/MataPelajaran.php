<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'matapelajaran'; // Sesuaikan dengan nama tabel di database
    protected $fillable = ['id', 'nama']; // Kolom yang boleh diisi
}