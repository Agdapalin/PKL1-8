@extends('backend.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3">Tambah Nilai</h4>

    <a href="{{ route('nilai.index') }}" class="btn btn-secondary btn-sm mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="student_id" class="form-label">Nama Siswa</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Nama Guru</label>
                    <select name="teacher_id" id="teacher_id" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-control" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($mapel as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Nilai
                </button>
            </form>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    .card {
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 5px;
    }

    .btn {
        border-radius: 5px;
    }
</style>

@endsection
