<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Pengadaan;
use App\Models\Barang;
use DB;

class C_pengadaan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengadaan = Pengadaan::orderBy('timestamp','desc')->get();
        $barang = Barang::all();
        return view('/pengadaan/pengadaan',compact('pengadaan','barang'),['x' => 'pengadaan']);
    }
    
    public function update(Request $request, $id)
    {
        Pengadaan::where('id_pengadaan',$id)
        ->update([
            'nama_pemasok' => $request->nama_pemasok,
            'tgl_pengadaan' => $request->tgl_pengadaan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pengadaan')->with('status','Data Berhasil Diubah!!!');
    }
    public function updateDetail(Request $request, $id, $id2)
    {
        $stok = $request->stok_barange + ($request->jumlah_barang - $request->stok_jumlah);
        //dd($request->stok_barange);
        $barang_tot = DB::table('detail_pengadaan')->where('id_pengadaan',$id)->where('id_barang',$id2)->get();
        foreach ($barang_tot as $bt){
            $btotal = $bt->total_harga_barang;
        }
        $pengadaan_tot = Pengadaan::where('id_pengadaan',$id)->get();
        foreach ($pengadaan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang - $btotal);
        Pengadaan::where('id_pengadaan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
        ]);
        Barang::where('id_barang',$id2)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_pengadaan')->where('id_pengadaan',$id)->where('id_barang',$id2)->update([
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/pengadaan')->with('status','Data Berhasil Diubah!!!');
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
        Pengadaan::create([
            'nama_pemasok' => $request->nama_pemasok,
            'tgl_pengadaan' => $request->tgl_pengadaan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pengadaan')->with('status','Data Berhasil Ditambahkan!!!'); 
    }
    public function storeDetail(Request $request, $id)
    {
        $stok = $request->stok_barang + $request->jumlah_barang;
        //dd($request->stok_barang);
        $pengadaan_tot = Pengadaan::where('id_pengadaan',$id)->get();
        foreach ($pengadaan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang);
        Pengadaan::where('id_pengadaan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
        ]);
        Barang::where('id_barang',$request->id_barang)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_pengadaan')->insert([
			'id_pengadaan' => $request->id_pengadaan,
			'id_barang' => $request->id_barang,
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/pengadaan')->with('status','Barang Berhasil Ditambahkan!!!'); 
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
        //
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