<?php

namespace App\Http\Controllers\Alternatif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{

    public function index()
    {
        $data = Alternatif::all();
        return view("admin.alternatif", compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_destinasi' => 'required',
            'kode' => 'required',
            'alamat_destinasi' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->only(['nama_destinasi', 'kode', 'alamat_destinasi']);
        Alternatif::create($data);

        return redirect()->route('admin.alternatif')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_destinasi' => 'required',
            'kode' => 'required',
            'alamat_destinasi' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->only(['nama_destinasi', 'kode', 'alamat_destinasi']);
        Alternatif::whereId($id)->update($data);

        return redirect()->route('admin.alternatif')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $data = Alternatif::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.alternatif')->with('success', 'Data berhasil dihapus.');
    }

}


