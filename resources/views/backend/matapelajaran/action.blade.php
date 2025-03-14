<a href="{{ route('mata_pelajaran.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('mata_pelajaran.destroy', $row->id) }}" method="POST" id="delete-form-{{ $row->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $row->id }})">Hapus</button>
                                            </form>