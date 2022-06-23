<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Pemasok;

class C_pemasok extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasok = Pemasok::orderBy('timestamp','desc')->get();
        return view('/pemasok/pemasok',compact('pemasok'),['x' => 'pemasok']);
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
        Pemasok::create([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat_pemasok' => $request->alamat_pemasok,
            'no_telp_pemasok' => $request->no_telp_pemasok,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pemasok')->with('status','Data Berhasil Ditambahkan!!!'); 
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
        Pemasok::where('id_pemasok',$id)
        ->update([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat_pemasok' => $request->alamat_pemasok,
            'no_telp_pemasok' => $request->no_telp_pemasok,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/pemasok')->with('status','Data Berhasil Diubah!!!');
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