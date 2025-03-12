@extends('backend.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- Header dengan posisi sticky -->
                    <div class="card-header d-flex justify-content-between align-items-center sticky-header">
                        <div class="card-title">Edit Siswa</div>
                        <a href="{{ route('student') }}" class="btn btn-info btn-sm">Kembali</a>
                    </div>

                    <div class="card-body form-container">
                        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $student->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">No. Telepon</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $student->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class" class="col-md-4 col-form-label text-md-right">Kelas</label>
                                <div class="col-md-6">
                                    <input id="class" type="text" class="form-control" name="class" value="{{ $student->class }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="addres" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input id="addres" type="text" class="form-control" name="addres" value="{{ $student->addres }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Foto</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image">
                                    @if($student->image)
                                        <img src="{{ asset('storage/'.$student->image) }}" class="mt-2" width="100">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- End of form-container -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Menjadikan header tetap terlihat saat scroll */
    .sticky-header {
        position: sticky;
        top: 0;
        background: white;
        z-index: 100;
        border-bottom: 1px solid #ddd;
    }

    /* Mengatur form agar bisa di-scroll */
    .form-container {
        max-height: 400px; /* Menentukan tinggi maksimal */
        overflow-y: auto;  /* Aktifkan scroll vertikal */
        padding: 10px;
    }
</style>

@endsection
