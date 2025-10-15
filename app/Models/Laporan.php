<?php

// Buka file: app/Models/Laporan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tambahkan baris ini
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
    ];

    // Tambahkan ini untuk relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
