<?php

namespace App\Http\Controllers\Perhitungan;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function perhitungan()
    {
        $alternatifs = Alternatif::all();
        $kriteria = Kriteria::all();
        $nilai = Penilaian::all();

        // Ambil bobot dan tipe dari tabel kriteria
        $bobot = $kriteria->pluck('bobot')->toArray();
        $tipeKriteria = $kriteria->pluck('tipe')->toArray(); // asumsi kolom 'type' berisi 'benefit' atau 'cost'

        // 1. Normalisasi Matriks Keputusan
        $nilaiMatriks = $nilai->map(function ($item) {
            return [
                'C1' => $item->C1,
                'C2' => $item->C2,
                'C3' => $item->C3,
                'C4' => $item->C4,
                'C5' => $item->C5,
            ];
        })->toArray();

        $jumlahAlternatif = count($nilaiMatriks);
        $jumlahKriteria = count($bobot);

        $matriksNormalisasi = [];
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $sum = 0;
            for ($i = 0; $i < $jumlahAlternatif; $i++) {
                $sum += pow($nilaiMatriks[$i]["C" . ($j + 1)], 2);
            }
            $sum = sqrt($sum);
            for ($i = 0; $i < $jumlahAlternatif; $i++) {
                $matriksNormalisasi[$i][$j] = $nilaiMatriks[$i]["C" . ($j + 1)] / $sum;
            }
        }

        // 2. Normalisasi Matriks Keputusan Terbobot
        $matriksNormalisasiTerbobot = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $matriksNormalisasiTerbobot[$i][$j] = $matriksNormalisasi[$i][$j] * $bobot[$j];
            }
        }

        // 3. Tentukan solusi ideal positif dan negatif
        $A_plus = [];
        $A_minus = [];
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            if ($tipeKriteria[$j] == 'benefit') {
                $A_plus[$j] = max(array_column($matriksNormalisasiTerbobot, $j));
                $A_minus[$j] = min(array_column($matriksNormalisasiTerbobot, $j));
            } else {
                $A_plus[$j] = min(array_column($matriksNormalisasiTerbobot, $j));
                $A_minus[$j] = max(array_column($matriksNormalisasiTerbobot, $j));
            }
        }

        // 4. Hitung jarak positif dan negatif dari solusi ideal
        $D_plus = [];
        $D_minus = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            $D_plus[$i] = 0;
            $D_minus[$i] = 0;
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $D_plus[$i] += pow($matriksNormalisasiTerbobot[$i][$j] - $A_plus[$j], 2);
                $D_minus[$i] += pow($matriksNormalisasiTerbobot[$i][$j] - $A_minus[$j], 2);
            }
            $D_plus[$i] = sqrt($D_plus[$i]);
            $D_minus[$i] = sqrt($D_minus[$i]);
        }

        // 5. Hitung nilai preferensi untuk setiap alternatif
        $nilaiPreferensi = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            $nilaiPreferensi[$i] = $D_minus[$i] / ($D_plus[$i] + $D_minus[$i]);
        }

        // Gabungkan nilai preferensi dengan alternatif
        $hasil = $alternatifs->map(function ($alternatif, $index) use ($nilaiPreferensi, $D_plus, $D_minus) {
            return [
                'alternatif' => $alternatif,
                'nilai_preferensi' => $nilaiPreferensi[$index],
                'jarak_positif' => $D_plus[$index],
                'jarak_negatif' => $D_minus[$index],
            ];
        });

        // Urutkan hasil berdasarkan nilai preferensi
        $hasil = $hasil->sortByDesc('nilai_preferensi');

        return view('admin.perhitungan', compact('hasil', 'alternatifs', 'kriteria', 'matriksNormalisasi', 'matriksNormalisasiTerbobot', 'A_plus', 'A_minus'));
    }
}
