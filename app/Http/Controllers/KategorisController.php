<?php

namespace App\Http\Controllers;

use App\Models\Kategoris;
use Illuminate\Http\Request;

class KategorisController extends Controller
{
    public function index()
    {
        $kategoris = Kategoris::all();
        return view('admin.kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategoris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategoris::create($request->all());

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori created successfully.');
    }

    public function edit($id)
    {
        $kategoris = Kategoris::findOrFail($id);
        return view('admin.kategoris.edit', compact('kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategoris = Kategoris::findOrFail($id);
        $kategoris->update($request->all());

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori updated successfully.');
    }

    public function destroy($id)
    {
        $kategoris = Kategoris::findOrFail($id);
        $kategoris->delete();

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori deleted successfully.');
    }
}

