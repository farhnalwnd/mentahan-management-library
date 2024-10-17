<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_buku',
        'kategori_id',
        'jumlah',
        'upload_pdf',
        'upload_cover',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategoris::class, 'kategori_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'buku_id', 'user_id');
    }
}



