<?php

namespace App\Http\Controllers\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = Penilaian::with('alternatif')->get();
        $alternatif = Alternatif::all();
        return view("admin.penilaian", compact('data', 'alternatif'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alternatif_id' => 'required|exists:alternatif,id',
            'C1' => 'required|numeric|max:10',
            'C2' => 'required|numeric|max:10',
            'C3' => 'required|numeric|max:10',
            'C4' => 'required|numeric|max:10',
            'C5' => 'required|numeric|max:10',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = $request->only(['alternatif_id', 'C1', 'C2', 'C3', 'C4', 'C5']);
        Penilaian::create($data);

        return redirect()->route('admin.penilaian');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alternatif_id' => 'required|exists:alternatif,id',
            'C1' => 'required|numeric|max:10',
            'C2' => 'required|numeric|max:10',
            'C3' => 'required|numeric|max:10',
            'C4' => 'required|numeric|max:10',
            'C5' => 'required|numeric|max:10',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $matrixScore = Penilaian::findOrFail($id);
        $matrixScore->update($request->only(['alternatif_id', 'C1', 'C2', 'C3', 'C4', 'C5']));

        return redirect()->route('admin.penilaian');
    }

    public function destroy($id)
    {
        $matrixScore = Penilaian::findOrFail($id);
        $matrixScore->delete();

        return redirect()->route('admin.penilaian');
    }
}
