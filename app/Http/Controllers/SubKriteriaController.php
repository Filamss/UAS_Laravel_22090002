<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        return view('admin.subkriteria');
    }
}
