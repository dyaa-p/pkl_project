<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class KasMingguan extends Model
{
    protected $table = 'kasmingguans';

    public $fillable = ['user_id', 'status', 'minggu_ke', 'bulan', 'jumlah', 'tanggal_bayar'];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
    ];

    public function user() // 🔧 ganti ke singular
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}