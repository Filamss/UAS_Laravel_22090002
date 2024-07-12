<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query(); // Menggunakan query builder

        if ($request->get('search')) {
            $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');
        }
        if ($request->get('tanggal')) {
            $query->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $query->get(); // Mengambil data

        return view('admin.index', compact('data', 'request'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $photo = $request->file('photo');
        $filename = date('Y-m-d') . $photo->getClientOriginalName();
        $path = 'photo-user/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['password'] = Hash::make($request->password);
        $data['image'] = $filename;

        User::create($data);

        return redirect()->route('index')->with('success', 'User created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        if (!$data) {
            return redirect()->route('index')->with('error', 'User not found.');
        }

        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'nullable',
            'photo' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found.');
        }

        $user->email = $request->email;
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = date('Y-m-d') . $photo->getClientOriginalName();
            $path = 'photo-user/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($photo));
            $user->image = $filename;
        }

        $user->save();

        return redirect()->route('index')->with('success', 'User updated successfully.');
    }

    public function delete(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('index')->with('success', 'User deleted successfully.');
        }

        return redirect()->route('index')->with('error', 'User not found.');
    }
}
