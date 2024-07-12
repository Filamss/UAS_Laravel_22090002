@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Kriteria</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Sub Kriteria</h3>
                        </div>
                        <div class="card-body">
                            <!-- Harga -->
                            <h4 class="mt-3">Harga</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Rentang Harga</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sangat Rendah</td>
                                        <td>>Rp.40.000</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Rendah</td>
                                        <td>>Rp.30.000 - Rp.40.000</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sedang</td>
                                        <td>>Rp20.000 - Rp.30.000</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi</td>
                                        <td>>Rp10.000 - Rp.20.000</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Tinggi</td>
                                        <td>Rp.0 - Rp10.000</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Waktu -->
                            <h4 class="mt-3">Waktu</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Rentang Waktu</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sangat Rendah</td>
                                        <td>10.00 - 18.00</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Rendah</td>
                                        <td>09.00 - 18.00</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sedang</td>
                                        <td>08.00 - 18.00</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi</td>
                                        <td>07.00 - 22.00</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Tinggi</td>
                                        <td>Tidak ada batas waktu kunjungan</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Rating -->
                            <h4 class="mt-3">Rating</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sangat Buruk</td>
                                        <td>Sangat Buruk</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Buruk</td>
                                        <td>Buruk</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sedang</td>
                                        <td>Sedang</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Baik</td>
                                        <td>Baik</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Baik</td>
                                        <td>Sangat Baik</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Jarak -->
                            <h4 class="mt-3">Jarak</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Rentang Jarak</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sangat Jauh</td>
                                        <td>> 30 KM</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Jauh</td>
                                        <td>> 20 KM - 30 KM</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sedang</td>
                                        <td>> 10 KM - 20 KM</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Dekat</td>
                                        <td>> 5 KM - 10 KM</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Dekat</td>
                                        <td>< 5 KM</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Fasilitas -->
                            <h4 class="mt-3">Fasilitas</h4>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tidak Ada</td>
                                        <td>Tidak Ada</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Kurang Lengkap</td>
                                        <td>Kurang Lengkap</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>Sedang</td>
                                        <td>Sedang</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Lengkap</td>
                                        <td>Lengkap</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>Sangat Lengkap</td>
                                        <td>Sangat Lengkap</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
