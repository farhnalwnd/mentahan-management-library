<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Pastikan middleware admin sudah terpasang
    }

    public function index()
    {
        return view('admin.dashboard'); // Pastikan view ini ada
    }
}
