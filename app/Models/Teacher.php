<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher'; // Pastikan ini mengarah ke tabel 'teachers'
    
    protected $fillable = ['name', 'email', 'phone', 'subject', 'gender', 'addres', 'photo'];
}
