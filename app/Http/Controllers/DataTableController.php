<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DataTableController extends Controller
{
    public function clientside(Request $request){
        $query = User::query(); // Menggunakan query builder
    
        if($request->get('search')){
            $query->where('name', 'LIKE', '%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }
        if($request->get('tanggal')){
            $query->where('name', 'LIKE', '%'.$request->get('search').'%')
            ->orWhere('email','LIKE','%'.$request->get('search').'%');
        }
    
        $data = $query->get(); // Mengambil data
    
        return view('datatable.clientside', compact('data', 'request'));
    }

    public function serverside(Request $request){
        if($request->ajax()){
            $data = User::latest()->get(); // or use User::query() if needed
            return DataTables::of($data)
                ->addColumn('no', function($data){
                    return 'ini nomor';
                })
                ->addColumn('photo', function($data){
                    return '<img src="'.asset('storage/photo-user/' . $data->image).'" alt="No Image" width="100">';
                })
                ->addColumn('nama', function($data){
                    return $data->name;
                })
                ->addColumn('email', function($data){
                    return $data->email;
                })
                ->addColumn('action', function($data){
                    return '<a href="'.route('admin.edit', ['id' => $data->id]).'"
                                                    class="btn btn-primary"><i class="fas fa-pen"></i> Edit </a>
                                                <a data-toggle="modal" data-target="#modal-hapus'.$data->id.'"
                                                    class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus </a>';
                })
                ->rawColumns(['photo','action'])
                ->make(true);
        }
        return view('datatable.serverside');
    }
    
    
}
