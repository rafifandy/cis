<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Laporan;
use App\Models\Pengadaan;
use App\Models\Penjualan;
use App\Models\Barang;
use PDF;

class C_laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$rekap = Rekap::orderBy('timestamp','desc')->get();
        $barang = Barang::all();
        $penjualan = Penjualan::all();
        $pengadaan = Pengadaan::all();
        $tgl = ['2022-05-17'];
        //$rbarang = Barang::groupBy('id_barang')->get();
        return view('/rekap/rekap',compact('pengadaan','penjualan','barang','tgl'),['x' => 'rekap']);
    }
    
    public function update(Request $request, $id)
    {
        Rekap::where('id_rekap',$id)
        ->update([
            'nama_rekap' => $request->nama_rekap,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/rekap')->with('status','Data Berhasil Diubah!!!');
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
        Rekap::create([
            'nama_rekap' => $request->nama_rekap,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/rekap')->with('status','Data Berhasil Ditambahkan!!!'); 
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