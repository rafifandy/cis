<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Penjualan;
use App\Models\Barang;
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
        $penjualan = Penjualan::all();
        return view('/penjualan/penjualan',compact('penjualan'));
    }
    public function index2()
    {
        return view('/penjualan/nota_ex2');
    }
    public function cetak(Request $request, $id)
    {
    	$penjualan = Penjualan::where('id_penjualan',$id)->get();
 
    	$pdf = PDF::loadview('/penjualan/cetak',compact('penjualan'));
    	return $pdf->stream('nota');
    }
    public function update(Request $request, $id)
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
        $request->validate([
            'nama_pelanggan' => 'required|max:100',
        ]);
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_telp_pelanggan' => $request->no_telp_pelanggan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pelanggan')->with('status','Data Berhasil Ditambahkan!!!'); 
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