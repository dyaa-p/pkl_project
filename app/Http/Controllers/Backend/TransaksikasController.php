<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaksikas;
use Illuminate\Http\Request;

class TransaksikasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksikas::all();
        $title     = 'Hapus Data Transaksi!';
        $text      = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.transaksi.index', compact('transaksi', ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'jenis'      => 'required|in:pemasukkan,pengeluaran',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'nullable',
            'tanggal'    => 'required|date',
        ]);

        $transaksi             = new Transaksikas();
        $transaksi->jenis      = $request->jenis;
        $transaksi->jumlah     = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal    = $request->tanggal;
        $transaksi->save();
        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.transaksi.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksikas::findOrFail($id);

        return view('backend.transaksi.show', compact('transaksi'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksikas::findOrFail($id);

        return view('backend.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis'      => 'required|in:pemasukkan,pengeluaran',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'nullable',
            'tanggal'    => 'required|date',
        ]);

        $transaksi             = Transaksikas::findOrFail($id);
        $transaksi->jenis      = $request->jenis;
        $transaksi->jumlah     = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal    = $request->tanggal;
        $transaksi->save();
        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.transaksi.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        $transaksi->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.transaksi.index');

    }
}
