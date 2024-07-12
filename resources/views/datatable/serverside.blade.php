<!-- resources/views/datatable/serverside.blade.php -->
@extends('layout.main')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Server Side DataTable</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User (Server Side)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data User</h3>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="serverside">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#serverside').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.serverside') }}",
            columns: [
                { data: 'no', name: 'no' },
                { data: 'photo', name: 'photo' },
                { data: 'nama', name: 'nama' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection
