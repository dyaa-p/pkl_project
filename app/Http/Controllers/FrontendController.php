<?php
namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalPemasukkan  = Transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');
        $totalPembayaran  = Pembayaran::sum('jumlah');
        $saldoKas         = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        // Pengeluaran dari TransaksiKas
        $transaksi = Transaksikas::where('jenis', 'pengeluaran')->latest()->get();

        // ✅ Tambahkan ini — pemasukan dari tabel Pembayaran
        $pemasukan = Transaksikas::where('jenis', 'pemasukkan')->latest()->get();

        return view('index', compact(
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas',
            'transaksi',
            'pemasukan'   // ✅ kirim ke view
        ));
    }

    public function profile($id)
    {
        $jumlahUang = Pembayaran::where('user_id', $id)->sum('jumlah');
        return view('profile', compact('jumlahUang'));
    }
}