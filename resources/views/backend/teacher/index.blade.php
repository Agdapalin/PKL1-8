@extends('backend.app')

@section('content')

<div class="container">
    <h4 class="fw-bold mb-3">Halaman Guru</h4>

    <a href="{{ route('teacher.create') }}" class="btn btn-success btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah Guru
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
    <form action="{{ route('teacher') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Bidang</th>
                            <th>Alamat</th>
                            <th>JK</th>
                            <th>Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $index => $teacher)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->jabatan }}</td>
                            <td class="alamat">
                                {{ $teacher->addres }}
                            </td>
                            <td>{{ $teacher->gender }}</td>
                            <td>
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" width="50" height="50" class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $teachers->links() }}
            </div> <!-- End of table-responsive -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data guru akan dihapus secara permanen!",
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
    }
</script>

<!-- CSS -->
<style>
    .table-responsive {
        max-height: 400px; /* Tinggi tabel tetap nyaman */
        overflow-y: auto;
        border: 1px solid #ddd;
    }

    .table th, .table td {
        font-size: 13px; /* Ukuran teks sedang */
        padding: 7px; /* Padding pas */
        white-space: nowrap; /* Teks tetap dalam satu baris */
    }

    .table td.alamat {
        max-width: 200px; /* Batasi lebar kolom */
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
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
