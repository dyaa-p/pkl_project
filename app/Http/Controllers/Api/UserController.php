<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->user(),
        ]);
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $now = Carbon::now();
        $mingguKe = (int) ceil($now->day / 7);

        $totalPembayaran = Pembayaran::where('user_id', $user->id)->sum('jumlah');
        $totalPemasukan = Transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPembayaran + $totalPemasukan - $totalPengeluaran;
        $pemasukanTerbaru = Transaksikas::where('jenis', 'pemasukkan')
            ->latest('tanggal')
            ->first();
        $pengeluaranTerbaru = Transaksikas::where('jenis', 'pengeluaran')
            ->latest('tanggal')
            ->first();

        $kasBulanIni = KasMingguan::where('user_id', $user->id)
            ->where('bulan', $now->month)
            ->orderBy('minggu_ke')
            ->get();

        $kasMingguIni = $kasBulanIni->firstWhere('minggu_ke', $mingguKe);

        return response()->json([
            'status' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'ringkasan' => [
                    'total_pembayaran' => $totalPembayaran,
                    'total_pemasukan' => $totalPemasukan,
                    'total_pengeluaran' => $totalPengeluaran,
                    'saldo_kas' => $saldoKas,
                    'pemasukan_terbaru' => [
                        'jumlah' => $pemasukanTerbaru?->jumlah ?? 0,
                        'keterangan' => $pemasukanTerbaru?->keterangan ?? 'Belum ada data pemasukan',
                        'tanggal' => optional($pemasukanTerbaru?->tanggal)->format('Y-m-d'),
                    ],
                    'pengeluaran_terbaru' => [
                        'jumlah' => $pengeluaranTerbaru?->jumlah ?? 0,
                        'keterangan' => $pengeluaranTerbaru?->keterangan ?? 'Belum ada data pengeluaran',
                        'tanggal' => optional($pengeluaranTerbaru?->tanggal)->format('Y-m-d'),
                    ],
                    'bulan' => $now->month,
                    'minggu_ke' => $mingguKe,
                    'status_kas_minggu_ini' => $kasMingguIni?->status ?? 'belum',
                    'jumlah_kas_minggu_ini' => $kasMingguIni?->jumlah ?? 0,
                ],
                'kas_bulan_ini' => $kasBulanIni,
            ],
        ]);
    }

    public function pembayaran(Request $request)
    {
        $pembayaran = Pembayaran::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pembayaran,
        ]);
    }

    public function kasMingguan(Request $request)
    {
        $kasMingguan = KasMingguan::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $kasMingguan,
        ]);
    }
}
