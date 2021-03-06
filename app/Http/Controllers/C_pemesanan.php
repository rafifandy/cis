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
use App\Models\Gambar_barang;
use App\Models\Kategori_barang;
use DB;

class C_pemesanan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // pemesanan 1,2,null/0
    public function a_index()
    {
        $penjualan = Penjualan::orderBy('timestamp','desc')->where('pemesanan','2')->get();
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $view = Penjualan::orderBy('timestamp','desc')->where('pemesanan','1')->get();
        return view('/pemesanan/pemesanan',compact('penjualan','pelanggan','barang','view'),['x' => 'pemesanan']);
    }

    public function a_view()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $penjualan= Penjualan::orderBy('timestamp','desc')->where('pemesanan','1')->get();
        return view('/pemesanan/belum-submit',compact('penjualan','pelanggan','barang'),['x' => 'pemesanan']);
    }
    
    public function a_confirm(Request $request, $id)
    {
        Penjualan::where('id_penjualan',$id)
        ->update([
            'pemesanan' => $request->pemesanan,
        ]);
        return redirect('/penjualan')->with('status','Pemesanan dikonfirmasi'); 
    }

    public function c_index()
    {
        $penjualan = Penjualan::orderBy('timestamp','desc')->where('pemesanan','1')->get();
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $gambar = Gambar_barang::all();
        $kategori_barang = Kategori_barang::all();
        return view('/_customer/pemesanan',compact('penjualan','pelanggan','barang','gambar','kategori_barang'),['x' => 'pemesanan','k' => '10']);
    }

    public function c_indexKat($id)
    {
        $penjualan = Penjualan::orderBy('timestamp','desc')->where('pemesanan','1')->get();
        $pelanggan = Pelanggan::all();
        $barang = Barang::where('id_kategori',$id)->get();
        $gambar = Gambar_barang::all();
        $kategori_barang = Kategori_barang::all();
        return view('/_customer/pemesanan',compact('penjualan','pelanggan','barang','gambar','kategori_barang'),['x' => 'pemesanan','k' => $id+10]);
    }

    public function c_store(Request $request)
    {
        Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_penjualan' => $request->tgl_penjualan,
            'pemesanan' => $request->pemesanan,
        ]);
        return redirect('/cpemesanan')->with('status','Silahkan memilih barang'); 
    }

    public function c_submit(Request $request, $id)
    {
        Penjualan::where('id_penjualan',$id)
        ->update([
            'tgl_penjualan' => $request->tgl_penjualan,
            'pemesanan' => $request->pemesanan,
        ]);
        return redirect('/cpemesanan')->with('status','Pemesanan dikirim ke penjual'); 
    }

    public function c_storeDetail(Request $request, $id)
    {
        $stok = $request->stok_barang - $request->jumlah_barang;
        //dd($request->stok_barang);
        $penjualan_tot = Penjualan::where('id_penjualan',$id)->get();
        foreach ($penjualan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang);
        //dd($request->harga_barang);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
            'total_akhir' => $total,
        ]);
        Barang::where('id_barang',$request->id_barang)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->insert([
			'id_penjualan' => $request->id_penjualan,
			'id_barang' => $request->id_barang,
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/cpemesanan')->with('status','Barang Berhasil Ditambahkan!!!'); 
    }
    
    public function c_updateDetail(Request $request, $id, $id2)
    {
        $stok = $request->stok_barange - ($request->jumlah_barang - $request->stok_jumlah);
        //dd($request->stok_barange);
        $barang_tot = DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->get();
        foreach ($barang_tot as $bt){
            $btotal = $bt->total_harga_barang;
        }
        $penjualan_tot = Penjualan::where('id_penjualan',$id)->get();
        foreach ($penjualan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang - $btotal);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
            'total_akhir' => $total,
        ]);
        Barang::where('id_barang',$id2)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->update([
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/cpemesanan')->with('status','Data Berhasil Diubah!!!');
    }

    public function c_deleteDetail(Request $request, $id, $id2)
    {
        $stok = $request->stok_barange - ($request->jumlah_barang - $request->stok_jumlah);
        //dd($request->stok_barange);
        $barang_tot = DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->get();
        foreach ($barang_tot as $bt){
            $btotal = $bt->total_harga_barang;
        }
        $penjualan_tot = Penjualan::where('id_penjualan',$id)->get();
        foreach ($penjualan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang - $btotal);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
            'total_akhir' => $total,
        ]);
        Barang::where('id_barang',$id2)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->delete();

        return redirect('/cpemesanan')->with('status','Data Berhasil Dihapus!!!');
    }



    public function update(Request $request, $id)
    {
        if($request->tipe_p == 0){
            Penjualan::where('id_penjualan',$id)
            ->update([
                'id_pelanggan' => $request->id_pelanggan,
                'tgl_penjualan' => $request->tgl_penjualan,
                'keterangan' => $request->keterangan,
            ]);
        }
        elseif($request->tipe_p == 1){
            $potongan = $request->total - ($request->total*$request->potongan_penjualan/100);
            $t2 = null;
            Penjualan::where('id_penjualan',$id)
            ->update([
                'id_pelanggan' => $request->id_pelanggan,
                'tgl_penjualan' => $request->tgl_penjualan,
                'keterangan' => $request->keterangan,
                'tipe_potongan_pnj' => $request->tipe_p,
                'potongan_penjualan_t1' => $request->potongan_penjualan,
                'potongan_penjualan_t2' => $t2,
                'total_akhir' => $potongan,
            ]);
        }
        elseif($request->tipe_p == 2){
            $potongan = $request->total - $request->potongan_penjualan;
            $t1 = null;
            Penjualan::where('id_penjualan',$id)
            ->update([
                'id_pelanggan' => $request->id_pelanggan,
                'tgl_penjualan' => $request->tgl_penjualan,
                'keterangan' => $request->keterangan,
                'tipe_potongan_pnj' => $request->tipe_p,
                'potongan_penjualan_t1' => $t1,
                'potongan_penjualan_t2' => $request->potongan_penjualan,
                'total_akhir' => $potongan,
            ]);
        }
        return redirect('/penjualan')->with('status','Data Berhasil Diubah!!!');
    }

    public function updateDetail(Request $request, $id, $id2)
    {
        $stok = $request->stok_barange - ($request->jumlah_barang - $request->stok_jumlah);
        //dd($request->stok_barange);
        $barang_tot = DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->get();
        foreach ($barang_tot as $bt){
            $btotal = $bt->total_harga_barang;
        }
        $penjualan_tot = Penjualan::where('id_penjualan',$id)->get();
        foreach ($penjualan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang - $btotal);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
            'total_akhir' => $total,
        ]);
        Barang::where('id_barang',$id2)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->where('id_penjualan',$id)->where('id_barang',$id2)->update([
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/penjualan')->with('status','Data Berhasil Diubah!!!');
    }

    public function updatePembayaran(Request $request, $id, $id2)
    {
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
        ]);
        Pembayaran::where('id_pembayaran',$id2)
        ->update([
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar,
            'keterangan' => $request->keterangan,
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
    
    public function storeDetail(Request $request, $id)
    {
        $stok = $request->stok_barang - $request->jumlah_barang;
        //dd($request->stok_barang);
        $penjualan_tot = Penjualan::where('id_penjualan',$id)->get();
        foreach ($penjualan_tot as $pt){
            $total = $pt->total;
        }
        $total = $total + ($request->harga_barang*$request->jumlah_barang);
        Penjualan::where('id_penjualan',$id)
        ->update([
            'status' => $request->status,
            'total' => $total,
            'total_akhir' => $total,
        ]);
        Barang::where('id_barang',$request->id_barang)
        ->update([
            'stok' => $stok,
        ]);
        DB::table('detail_penjualan')->insert([
			'id_penjualan' => $request->id_penjualan,
			'id_barang' => $request->id_barang,
			'harga_barang' => $request->harga_barang,
			'jumlah_barang' => $request->jumlah_barang,
			'total_harga_barang' => $request->harga_barang*$request->jumlah_barang,
		]);
        return redirect('/penjualan')->with('status','Barang Berhasil Ditambahkan!!!'); 
    }
}