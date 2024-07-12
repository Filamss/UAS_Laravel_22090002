<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $data = Kriteria::all();
        return view("admin.kriteria", compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'bobot' => ['required', 'numeric', 'max:5'],
            'tipe' => ['required', \Illuminate\Validation\Rule::in(['benefit', 'cost'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->only(['nama', 'kode', 'bobot', 'tipe']);
        Kriteria::create($data);

        return redirect()->route('admin.kriteria');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'keterangan' => 'nullable',
            'bobot' => ['required', 'numeric', 'max:5'],
            'tipe' => ['required', \Illuminate\Validation\Rule::in(['benefit', 'cost'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->only(['nama', 'kode', 'bobot', 'tipe']);
        Kriteria::whereId($id)->update($data);

        return redirect()->route('admin.kriteria');
    }

    public function delete($id)
    {
        $data = Kriteria::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.kriteria');
    }
}
