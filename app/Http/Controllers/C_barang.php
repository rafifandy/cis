<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Barang;
use App\Models\Kategori_barang;
use App\Models\Gambar_barang;
use App\Models\Pelanggan;



class C_barang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function guest_index()
    {
        $barang = Barang::orderBy('timestamp','desc')->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/__guest/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => '0']);
    }

    public function guest_indexKat($id)
    {
        $barang = Barang::orderBy('timestamp','desc')->where('id_kategori',$id)->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/__guest/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => $id]);
    }

    public function customer_index()
    {
        $barang = Barang::orderBy('timestamp','desc')->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/_customer/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => '0']);
    }

    public function customer_indexKat($id)
    {
        $barang = Barang::orderBy('timestamp','desc')->where('id_kategori',$id)->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/_customer/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => $id]);
    }

    public function index()
    {
        $barang = Barang::orderBy('timestamp','desc')->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/barang/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => '0']);
    }

    public function indexKat($id)
    {
        $barang = Barang::orderBy('timestamp','desc')->where('id_kategori',$id)->get();
        $kategori_barang = Kategori_barang::all();
        $gambar = Gambar_barang::all();
        return view('/barang/barang',compact('barang','kategori_barang','gambar'),['x' => 'barang','k' => $id]);
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
            'nama_barang' => 'required|max:100',
        ]);
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/barang')->with('status','Data Berhasil Ditambahkan!!!'); 
    }
    public function storeGambar(Request $request, $id)
    {
        $file = $request->file('foto_barang');
        $nama_barang = time().'-'.$file->getClientOriginalName();
        Storage::disk('local')->put($nama_barang, file_get_contents($file));
        Gambar_barang::create([
            'id_barang' => $id,
            'foto_barang' => $nama_barang,
        ]);
        return redirect('/barang')->with('status','Data Berhasil Ditambahkan!!!'); 
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:100',
        ]);
        Barang::where('id_barang',$id)
        ->update([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/barang')->with('status','Data Berhasil Diubah!!!');
    }

    public function updateGambar(Request $request, $id, $id2)
    {
        $file = $request->file('foto_barang');
        $nama_barang = time().'-'.$file->getClientOriginalName();
        Storage::disk('local')->put($nama_barang, file_get_contents($file));
        Gambar_barang::where('id_gambar',$id2)
        ->update([
            'foto_barang' => $nama_barang,
        ]);
        return redirect('/barang')->with('status','Data Berhasil Diubah!!!');
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