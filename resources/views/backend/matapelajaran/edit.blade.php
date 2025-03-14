@extends('backend.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-3">Edit Mata Pelajaran</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('mata_pelajaran.update', $matapelajaran->id) }}" method="POST">
                @csrf
                <!-- HAPUS @method('PUT') karena route hanya mendukung POST -->
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $matapelajaran->nama) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mata_pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
