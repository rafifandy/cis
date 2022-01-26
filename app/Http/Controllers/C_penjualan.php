<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Barang;
use DB;
use PDF;

class C_penjualan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::orderBy('timestamp','desc')->get();
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('/penjualan/penjualan',compact('penjualan','pelanggan','barang'),['x' => 'penjualan']);
    }
    public function index2()
    {
        return view('/penjualan/nota_ex');
    }
    public function cetak(Request $request, $id)
    {
    	$penjualan = Penjualan::where('id_penjualan',$id)->get();
 
    	$pdf = PDF::loadview('/penjualan/cetak',compact('penjualan'));
    	return $pdf->stream('nota');
    }

    public function update(Request $request, $id)
    {
        Penjualan::where('id_penjualan',$id)
        ->update([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_penjualan' => $request->tgl_penjualan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/penjualan')->with('status','Data Berhasil Diubah!!!');
    }
    public function updateDetail(Request $request, $id, $id2)
    {
        $stok = $request->stok_barange - ($request->jumlah_barang - $request->stok_jumlah);
        //dd($request->stok_barange);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
        ]);
        Barang::where('id_barang',$id2)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->update([
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang
		]);
        return redirect('/penjualan')->with('status','Data Berhasil Diubah!!!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_penjualan' => $request->tgl_penjualan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/penjualan')->with('status','Data Berhasil Ditambahkan!!!'); 
    }
    public function storeDetail(Request $request, $id)
    {
        $stok = $request->stok_barang - $request->jumlah_barang;
        //dd($request->stok_barang);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
        ]);
        Barang::where('id_barang',$request->id_barang)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->insert([
			'id_penjualan' => $request->id_penjualan,
			'id_barang' => $request->id_barang,
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang
		]);
        return redirect('/penjualan')->with('status','Barang Berhasil Ditambahkan!!!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|max:100',
        ]);
        Pelanggan::where('id_pelanggan',$id)
        ->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_telp_pelanggan' => $request->no_telp_pelanggan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pelanggan')->with('status','Data Berhasil Diubah!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}