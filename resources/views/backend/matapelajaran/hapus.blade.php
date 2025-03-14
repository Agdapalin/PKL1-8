@extends('backend.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Konfirmasi Hapus Mata Pelajaran</div>
                        <a href="{{ route('mata_pelajaran.index') }}" class="btn btn-info btn-sm">Kembali</a>
                    </div>
                    <div class="card-body text-center">
                        <h5>Apakah Anda yakin ingin menghapus mata pelajaran <strong>{{ $mapel->nama }}</strong>?</h5>
                        
                        <!-- Form Hapus dengan Konfirmasi SweetAlert -->
                        <form id="deleteForm" action="{{ route('mata_pelajaran.destroy', $mapel->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="confirmDelete" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                            <a href="{{ route('mata_pelajaran.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#confirmDelete').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteForm').submit();
                }
            });
        });
    });
</script>
@endsection
