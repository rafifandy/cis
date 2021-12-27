<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Barang;

class C_barang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('/barang/barang',compact('barang'));
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
        if($request->file('foto_barang') != null){
            $file = $request->file('foto_barang');
            $nama_barang = time().'-'.$file->getClientOriginalName();
            Storage::disk('local')->put($nama_barang, file_get_contents($file));
            Barang::create([
                'nama_barang' => $request->nama_barang,
                'harga_sementara' => $request->harga_sementara,
                'keterangan' => $request->keterangan,
                'foto_barang' => $nama_barang,
            ]);
        }
        else{
            Barang::create([
                'nama_barang' => $request->nama_barang,
                'harga_sementara' => $request->harga_sementara,
                'keterangan' => $request->keterangan,
            ]);
        }
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
        if($request->file('foto_barang') != null){
            $file = $request->file('foto_barang');
            $nama_barang = time().'-'.$file->getClientOriginalName();
            Storage::disk('local')->put($nama_barang, file_get_contents($file));
            Barang::where('id_barang',$id)
            ->update([
                'nama_barang' => $request->nama_barang,
                'harga_sementara' => $request->harga_sementara,
                'keterangan' => $request->keterangan,
                'foto_barang' => $nama_barang,
            ]);
        }
        else{
            Barang::where('id_barang',$id)
            ->update([
                'nama_barang' => $request->nama_barang,
                'harga_sementara' => $request->harga_sementara,
                'keterangan' => $request->keterangan,
            ]);
        }
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