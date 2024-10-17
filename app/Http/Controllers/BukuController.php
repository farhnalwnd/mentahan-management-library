<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategoris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');

        $query = Buku::query();
        
        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }
        
        $bukus = $query->paginate(10);
        
        $kategoris = Kategoris::all();
        
        return view('admin.buku.index', compact('bukus', 'kategoris'));
    }
    
    public function create()
    {
        $kategoris = Kategoris::all();

        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah' => 'required|integer',
            'upload_pdf' => 'nullable|mimes:pdf|max:20480',
            'upload_cover' => 'nullable|image|max:2048',    
        ]);
    
        $pdfPath = $request->hasFile('upload_pdf') ? $request->file('upload_pdf')->store('pdfs', 'public') : null;
    
        $coverPath = $request->hasFile('upload_cover') ? $request->file('upload_cover')->store('covers', 'public') : null;
    
        Buku::create([
            'nama_buku' => $request->nama_buku,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'upload_pdf' => $pdfPath,
            'upload_cover' => $coverPath,
        ]);
    
        return redirect()->route('admin.buku.index')->with('success', 'Buku created successfully.');
    }
    
    public function edit($id)
    {
        $bukus = Buku::findOrFail($id);
        $kategoris = Kategoris::all();

        return view('admin.buku.edit', compact('bukus', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah' => 'required|integer',
            'upload_pdf' => 'nullable|mimes:pdf|max:20480',
            'upload_cover' => 'nullable|image|max:2048',
        ]);
    
        $bukus = Buku::findOrFail($id);
    
        if ($request->hasFile('upload_pdf')) {
            if ($bukus->upload_pdf) {
                Storage::disk('public')->delete($bukus->upload_pdf);
            }
            $pdfPath = $request->file('upload_pdf')->store('pdfs', 'public');
        } else {
            $pdfPath = $bukus->upload_pdf;
        }
    
        if ($request->hasFile('upload_cover')) {
            if ($bukus->upload_cover) {
                Storage::disk('public')->delete($bukus->upload_cover);
            }
            $coverPath = $request->file('upload_cover')->store('covers', 'public');
        } else {
            $coverPath = $bukus->upload_cover;
        }
    
        $bukus->update([
            'nama_buku' => $request->nama_buku,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'upload_pdf' => $pdfPath,
            'upload_cover' => $coverPath,
        ]);
    
        return redirect()->route('admin.buku.index')->with('success', 'Buku updated successfully.');
    }

    public function destroy($id)
    {
        $bukus = Buku::findOrFail($id);

        if ($bukus->uploadpdf) {
            Storage::disk('public')->delete($bukus->uploadpdf);
        }
        if ($bukus->upload_cover) {
            Storage::disk('public')->delete($bukus->upload_cover);
        }

        $bukus->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku deleted successfully.');
    }
}
