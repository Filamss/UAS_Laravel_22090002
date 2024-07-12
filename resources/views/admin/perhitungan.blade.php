@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Perhitungan TOPSIS</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Matriks Normalisasi -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Matriks Normalisasi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matriksNormalisasi as $i => $row)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->nama_destinasi }}</td>
                                        @foreach($row as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Matriks Terbobot -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Matriks Terbobot</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matriksNormalisasiTerbobot as $i => $row)
                                    <tr>
                                        <td>{{ $alternatifs[$i]->nama_destinasi }}</td>
                                        @foreach($row as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Solusi Ideal -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Solusi Ideal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($kriteria as $k)
                                        <th>{{ $k->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ideal Positif</td>
                                        @foreach($A_plus as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Ideal Negatif</td>
                                        @foreach($A_minus as $value)
                                        <td>{{ number_format($value, 4) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Jarak Solusi Ideal -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jarak Solusi Ideal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Jarak Positif</th>
                                        <th>Jarak Negatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasil as $item)
                                    <tr>
                                        <td>{{ $item['alternatif']->nama_destinasi }}</td>
                                        <td>{{ number_format($item['jarak_positif'], 4) }}</td>
                                        <td>{{ number_format($item['jarak_negatif'], 4) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Nilai Preferensi -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nilai Preferensi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasil as $item)
                                    <tr>
                                        <td>{{ $item['alternatif']->nama_destinasi }}</td>
                                        <td>{{ number_format($item['nilai_preferensi'], 4) }}</td>
                                    </tr>
                                    @endforeach
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
