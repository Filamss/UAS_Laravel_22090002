@extends('layout.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penilaian </li>
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
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah
                                    Data</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
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
                                        <th style="width: 15%;">ID</th>
                                        <th style="width: 30%;">Nama Destinasi</th>
                                        <th style="width: 10%;">C1</th>
                                        <th style="width: 10%;">C2</th>
                                        <th style="width: 10%;">C3</th>
                                        <th style="width: 10%;">C4</th>
                                        <th style="width: 10%;">C5</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->alternatif->nama_destinasi }}</td>
                                        <td>{{ $m->C1 }}</td>
                                        <td>{{ $m->C2 }}</td>
                                        <td>{{ $m->C3 }}</td>
                                        <td>{{ $m->C4 }}</td>
                                        <td>{{ $m->C5 }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-edit{{ $m->id }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.penilaian.destroy', ['id' => $m->id]) }}"
                                                method="post" style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="modal-edit{{ $m->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalEditLabel{{ $m->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditLabel{{ $m->id }}">Edit Penilaian
                                                        </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.penilaian.update', ['id' => $m->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group">
                                                            <label for="alternatif_id">Program</label>
                                                            <select name="alternatif_id" class="form-control" required>
                                                                @foreach($alternatif as $a)
                                                                <option value="{{ $a->id }}"
                                                                    {{ $a->id == $m->alternatif_id ? 'selected' : '' }}>
                                                                    {{ $a->nama_destinasi }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="C1">C1</label>
                                                            <input type="number" name="C1" class="form-control" max="10"
                                                                value="{{ $m->C1 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="C2">C2</label>
                                                            <input type="number" name="C2" class="form-control" max="10"
                                                                value="{{ $m->C2 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="C3">C3</label>
                                                            <input type="number" name="C3" class="form-control" max="10"
                                                                value="{{ $m->C3 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="C4">C4</label>
                                                            <input type="number" name="C4" class="form-control" max="10"
                                                                value="{{ $m->C4 }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="C5">C5</label>
                                                            <input type="number" name="C5" class="form-control" max="10"
                                                                value="{{ $m->C5 }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- Add Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Tambah Penilaian </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.penilaian.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="alternatif_id">Alternatif</label>
                        <select name="alternatif_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Alternatif</option>
                            @foreach($alternatif as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_destinasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="C1">C1</label>
                        <input type="number" name="C1" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="C2">C2</label>
                        <input type="number" name="C2" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="C3">C3</label>
                        <input type="number" name="C3" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="C4">C4</label>
                        <input type="number" name="C4" class="form-control" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="C5">C5</label>
                        <input type="number" name="C5" class="form-control" max="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection