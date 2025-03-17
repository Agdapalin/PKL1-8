@extends('backend.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3">Halaman Nilai</h4>

    <a href="{{ route('nilai.create') }}" class="btn btn-success btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah Nilai
    </a>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    <!-- Form Pencarian -->
    <form action="{{ route('nilai.index') }}" method="GET" class="mb-3 d-flex justify-content-start">
        <div class="input-group" style="max-width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari siswa atau guru..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilai as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item->teacher->name }}</td>
                            <td>{{ $item->mapel->nama }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-button">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteForms = document.querySelectorAll(".delete-form");

        deleteForms.forEach(form => {
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data nilai akan dihapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- CSS -->
<style>
    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ddd;
    }

    .table th, .table td {
        font-size: 13px;
        padding: 7px;
        white-space: nowrap;
    }

    .table thead {
        position: sticky;
        top: 0;
        background: #212529;
        color: white;
        z-index: 10;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #e67e22;
    }

    .btn-warning:hover {
        background-color: #e67e22;
        border-color: #d35400;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #c0392b;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #a93226;
    }
</style>

@endsection
