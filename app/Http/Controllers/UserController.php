<?php

namespace App\Http\Controllers;

use App\Models\Buku; 
use App\Models\Favorite;
use App\Models\Kategoris;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Buku::query();
        
        $categoryId = $request->input('category_id');
        
        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }
        
        $bukus = $query->paginate(5); 
        
        $categories = Kategoris::all();
        
        return view('dashboard', compact('bukus', 'categories'));
    }

        public function addFavorite(Request $request)
        {
            $userId = auth()->id();
            $bukuId = $request->input('buku_id');
        
            $exists = Favorite::where('user_id', $userId)->where('buku_id', $bukuId)->exists();
            
            if (!$exists) {
                Favorite::create([
                    'user_id' => $userId,
                    'buku_id' => $bukuId,
                ]);
            }
        
            return response()->json(['message' => 'Buku telah ditambahkan ke favorit!']);
        }    
        
        public function showFavorites(Request $request)
        {
            $userId = auth()->id();
            $categoryId = $request->input('category_id');
    
            // Ambil semua buku favorit pengguna
            $query = Buku::whereIn('id', function($subQuery) use ($userId) {
                $subQuery->select('buku_id')
                         ->from('favorites')
                         ->where('user_id', $userId);
            });
    
            if ($categoryId) {
                $query->where('kategori_id', $categoryId);
            }
    
            $bukus = $query->get();
            $categories = Kategoris::all();
    
            return view('user.favorites', compact('bukus', 'categories'));
        }

        public function removeFavorite(Request $request)
        {
            $userId = auth()->id();
            $bukuId = $request->input('buku_id');

            // Hapus favorit berdasarkan user_id dan buku_id
            Favorite::where('user_id', $userId)->where('buku_id', $bukuId)->delete();

            return response()->json(['message' => 'Buku telah dihapus dari favorit!']);
        }

}
