<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;

class KasmingguanController extends Controller
{
    public function index()
    {
        $kas   = KasMingguan::latest()->get();
        $users = User::all();

        $title = 'Hapus Data Kas!';
        $text  = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.kas.index', compact('kas', 'users'));
    }

    public function show($id)
    {
        $kas = KasMingguan::findOrFail($id);

        $mingguKe = $kas->minggu_ke;
        $bulan = $kas->bulan;
        $userId = $kas->user_id;

        $pembayarans = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($pembayaran) use ($mingguKe) {
                return ceil(Carbon::parse($pembayaran->tanggal)->day / 7) == $mingguKe;
            });

        $totalJumlah = $pembayarans->sum('jumlah');

        $tanggalList = $pembayarans->map(function ($item) {
            $tanggal = Carbon::parse($item->tanggal)->format('d M Y');
            $jumlah  = number_format($item->jumlah, 0, '.', '.');
            return "{$tanggal} (Rp. {$jumlah})";
        });

        return view('backend.kas.show', compact('kas', 'totalJumlah', 'tanggalList'));
    }

    public function destroy($id)
    {
        $kas = KasMingguan::findOrFail($id);

        $mingguKe = $kas->minggu_ke;
        $bulan = $kas->bulan;
        $userId = $kas->user_id;

        $pembayarans = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($item) use ($mingguKe) {
                return ceil(Carbon::parse($item->tanggal)->day / 7) == $mingguKe;
            });

        foreach ($pembayarans as $pembayaran) {
            $pembayaran->delete();
        }

        $kas->delete();

        toast('Data kas dan pembayaran terkait berhasil dihapus', 'success');
        return redirect()->route('backend.kas.index');
    }
}