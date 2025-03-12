@extends('backend.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Konfirmasi Hapus Siswa</div>
                        <a href="{{ route('student') }}" class="btn btn-info btn-sm">Kembali</a>
                    </div>
                    <div class="card-body text-center">
                        <h5>Apakah Anda yakin ingin menghapus siswa <strong>{{ $student->name }}</strong>?</h5>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                            <a href="{{ route('student') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
