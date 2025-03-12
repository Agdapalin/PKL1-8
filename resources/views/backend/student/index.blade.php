@extends('backend.app')

@section('content')

<div class="container">
    <h3 class="fw-bold mb-3">Halaman Siswa</h3>
    <a href="{{ route('student.create') }}" class="btn btn-success mb-3">Tambah Siswa</a>

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

    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->addres }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>
                                @if($student->image)
                                    <img src="{{ asset('storage/' . $student->image) }}" width="50" height="50" class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- End of table-container -->

            <!-- PAGINATION -->
            <div class="d-flex justify-content-center mt-3">
                {{ $students->links('vendor.pagination.bootstrap-5') }}
            </div>
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
            text: "Data siswa akan dihapus secara permanen!",
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

<style>
    .table-container {
        max-height: 400px; /* Menentukan tinggi maksimal tabel */
        overflow-y: auto;  /* Mengaktifkan scroll vertikal */
        display: block;     /* Agar scroll bisa berfungsi */
        border: 1px solid #ddd; /* Menambahkan batas tabel */
    }

    .table-container thead {
        position: sticky;
        top: 0;
        background: #343a40;
        color: white;
        z-index: 10;
    }
</style>

@endsection
