<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['user_id', 'jumlah', 'tanggal'];

    // ✅ RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}