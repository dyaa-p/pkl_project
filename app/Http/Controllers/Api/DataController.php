<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use App\Models\User;

class DataController extends Controller
{
    public function dashboard()
    {
        $totalUser = User::count();
        $totalPemasukan = Transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');
        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas = $totalPembayaran + $totalPemasukan - $totalPengeluaran;

        return response()->json([
            'status' => true,
            'data' => [
                'total_user' => $totalUser,
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'total_pembayaran' => $totalPembayaran,
                'saldo_kas' => $saldoKas,
            ],
        ]);
    }

    public function pemasukan()
    {
        $pemasukan = Transaksikas::where('jenis', 'pemasukkan')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pemasukan,
        ]);
    }

    public function pengeluaran()
    {
        $pengeluaran = Transaksikas::where('jenis', 'pengeluaran')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pengeluaran,
        ]);
    }

    public function pembayaran()
    {
        $pembayaran = Pembayaran::with('user')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pembayaran,
        ]);
    }

    public function kasMingguan()
    {
        $kasMingguan = KasMingguan::with('user')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $kasMingguan,
        ]);
    }
}
