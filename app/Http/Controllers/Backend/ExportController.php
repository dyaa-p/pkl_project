<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Transaksikas;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $totalPemasukkan  = TransaksiKas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = TransaksiKas::where('jenis', 'pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas        = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        $saldoNunggak = KasMingguan::where('status', 'belum')
            ->get()
            ->sum(function ($kas) {
                return 10000 - $kas->jumlah;
            });


        $jenis = $request->jenis;
        $awal  = $request->awal;
        $akhir = $request->akhir;

        $kas       = collect();
        $transaksi = collect();

        if ($jenis === 'kas') {
            $kasQuery = KasMingguan::with('user');
            if ($awal && $akhir) {
                $kasQuery->whereBetween('tanggal_bayar', [$awal, $akhir]);
            }
            $kas = $kasQuery->get();

        } elseif ($jenis === 'pemasukkan' || $jenis === 'pengeluaran') {
            $trxQuery = Transaksikas::where('jenis', $jenis);
            if ($awal && $akhir) {
                $trxQuery->whereBetween('tanggal', [$awal, $akhir]);
            }
            $transaksi = $trxQuery->get();
        }

        // Cek apakah export Excel
        if ($request->export == 'excel') {
            $filename = 'laporan_' . $jenis . '_' . now()->format('Ymd_His') . '.xls';

            return response()->view('backend.laporan.export_excel', compact('kas', 'jenis', 'transaksi', 'saldoKas', 'saldoNunggak'))
                ->header('Content-Type', 'application/vnd.ms-excel')
                ->header('Content-Disposition', 'attachment; filename=laporan_kas.xls');

        }

        return view('backend.laporan.index', compact('kas', 'transaksi', 'jenis', 'saldoKas', 'saldoNunggak'));
    }
}
