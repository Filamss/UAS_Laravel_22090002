@extends('layout.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Kriteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kriteria</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <button class="btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah Data</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Kriteria</th>
                                        <th>Kode</th>
                                        <th>Bobot</th>
                                        <th>Tipe</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->nama }}</td>
                                        <td>{{ $k->kode }}</td>
                                        <td>{{ $k->bobot }}</td>
                                        <td>
                                            <span class="badge @if($k->tipe == 'benefit') badge-success @else badge-danger @endif text-uppercase">
                                                {{ $k->tipe }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-edit{{ $k->id }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{ $k->id }}">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="modal-edit{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel{{ $k->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditLabel{{ $k->id }}">Edit Kriteria</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kriteria.update', ['id' => $k->id]) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group">
                                                            <label for="nama">Nama Kriteria</label>
                                                            <input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kode">Kode</label>
                                                            <input type="text" name="kode" class="form-control" value="{{ $k->kode }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bobot">Bobot</label>
                                                            <input type="number" name="bobot" class="form-control" value="{{ $k->bobot }}" required max="5">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipe">Tipe</label>
                                                            <select name="tipe" class="form-control" required>
                                                                <option value="benefit" {{ $k->tipe == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                                                <option value="cost" {{ $k->tipe == 'cost' ? 'selected' : '' }}>Cost</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hapus Modal -->
                                    <div class="modal fade" id="modal-hapus{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel{{ $k->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusLabel{{ $k->id }}">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Kamu Akan Menghapus Kriteria <b>{{ $k->name }}</b>?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                    <form action="{{ route('admin.kriteria.delete', ['id' => $k->id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Tambah Modal -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.kriteria.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Kriteria</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="number" name="bobot" class="form-control" required max="5">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select name="tipe" class="form-control" required>
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
