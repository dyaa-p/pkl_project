<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        // ✅ FIX: pakai with('user')
        $pembayaran = Pembayaran::with('user')->latest()->get();
        $users      = User::all();

        $title = 'Hapus Data Bayar!';
        $text  = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.pembayaran.index', compact('pembayaran', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('backend.pembayaran.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Simpan pembayaran
        $pembayaran = Pembayaran::create([
            'user_id' => $request->user_id,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        $tanggal  = Carbon::parse($request->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;

        $user = User::find($request->user_id);

        $kasMingguan = KasMingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKe)
            ->where('bulan', $bulan)
            ->first();

        if ($kasMingguan) {

            if ($kasMingguan->status == 'lunas') {
                toast("Uang kas minggu ini untuk {$user->name} sudah lunas", 'info');
                return redirect()->route('backend.pembayaran.create');
            }

            $kasMingguan->jumlah += $request->jumlah;
            $kasMingguan->status = $kasMingguan->jumlah >= 10000 ? 'lunas' : 'belum';
            $kasMingguan->tanggal_bayar = $tanggal;
            $kasMingguan->save();

        } else {

            KasMingguan::create([
                'user_id'       => $request->user_id,
                'minggu_ke'     => $mingguKe,
                'bulan'         => $bulan,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggal,
                'status'        => $request->jumlah >= 10000 ? 'lunas' : 'belum',
            ]);
        }

        toast('Data pembayaran berhasil ditambah', 'success');
        return redirect()->route('backend.pembayaran.index');
    }

    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $users      = User::all();

        return view('backend.pembayaran.edit', compact('pembayaran', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembayaranLama = Pembayaran::findOrFail($id);

        $tanggalLama = Carbon::parse($pembayaranLama->tanggal);
        $mingguKeLama = ceil($tanggalLama->day / 7);
        $bulanLama = $tanggalLama->month;

        $kasLama = KasMingguan::where('user_id', $pembayaranLama->user_id)
            ->where('minggu_ke', $mingguKeLama)
            ->where('bulan', $bulanLama)
            ->first();

        if ($kasLama) {
            $kasLama->jumlah -= $pembayaranLama->jumlah;

            if ($kasLama->jumlah <= 0) {
                $kasLama->delete();
            } else {
                $kasLama->status = $kasLama->jumlah >= 10000 ? 'lunas' : 'belum';
                $kasLama->save();
            }
        }

        $pembayaranLama->update([
            'user_id' => $request->user_id,
            'jumlah'  => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        $tanggalBaru = Carbon::parse($request->tanggal);
        $mingguKeBaru = ceil($tanggalBaru->day / 7);
        $bulanBaru = $tanggalBaru->month;

        $kasBaru = KasMingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKeBaru)
            ->where('bulan', $bulanBaru)
            ->first();

        if ($kasBaru) {
            $kasBaru->jumlah += $request->jumlah;
            $kasBaru->status = $kasBaru->jumlah >= 10000 ? 'lunas' : 'belum';
            $kasBaru->tanggal_bayar = $tanggalBaru;
            $kasBaru->save();
        } else {
            KasMingguan::create([
                'user_id'       => $request->user_id,
                'minggu_ke'     => $mingguKeBaru,
                'bulan'         => $bulanBaru,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggalBaru,
                'status'        => $request->jumlah >= 10000 ? 'lunas' : 'belum',
            ]);
        }

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.pembayaran.index');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $tanggal  = Carbon::parse($pembayaran->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;

        $pembayaran->delete();

        $pembayarans = Pembayaran::where('user_id', $pembayaran->user_id)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($item) use ($mingguKe) {
                return ceil(Carbon::parse($item->tanggal)->day / 7) == $mingguKe;
            });

        if ($pembayarans->isEmpty()) {
            KasMingguan::where('user_id', $pembayaran->user_id)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->delete();
        } else {
            $totalJumlah = $pembayarans->sum('jumlah');
            $tanggalTerakhir = $pembayarans->last()->tanggal;

            KasMingguan::where('user_id', $pembayaran->user_id)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->update([
                    'jumlah' => $totalJumlah,
                    'status' => $totalJumlah >= 10000 ? 'lunas' : 'belum',
                    'tanggal_bayar' => $tanggalTerakhir,
                ]);
        }

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.pembayaran.index');
    }
}