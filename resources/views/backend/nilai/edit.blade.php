@extends('backend.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3">Edit Nilai</h4>

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
            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="student_id" class="form-label">Nama Siswa</label>
                    <select name="student_id" id="student_id" class="form-control select2" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $nilai->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Nama Guru</label>
                    <select name="teacher_id" id="teacher_id" class="form-control select2" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $nilai->teacher_id == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" class="form-control select2" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}" {{ $nilai->mapel_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" value="{{ $nilai->nilai }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Perbarui Nilai
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

@section('script')
<!-- Memuat CSS dan JS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            placeholder: "Pilih opsi",
            allowClear: true,
            width: '100%'  // Pastikan Select2 menyesuaikan dengan lebar container
        });
    });
</script>
@endsection