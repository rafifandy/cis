@extends('layout/master')
@section('title','Penjualan')
@section('css')
    <style>
        td{
            vertical-align: top;
            font-size: 13px;
        }
        th{
            font-size: 14px;
        }
    </style>
@endsection
@section('content')
<body>
	<center>
        <br/>
		<h1>Penjualan</h1>
	</center>
	<br/>
	<br/>
    <div class="container">
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Penjualan Baru</button><hr/>
        @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
        @endif
	    <table id="t" class="display cell-border">
            <thead>
                <tr style="background-color:#BDDFFF">
                    <th>No</th>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>List Barang</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th>Tgl Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0 ?>
            @foreach($penjualan as $p)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$p->id_penjualan}}</td>
                    <td>{{$p->pelanggan->id_pelanggan}} - {{$p->pelanggan->nama_pelanggan}}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_penjualan)->format('d M Y')}}</td>
                    <td style="">
                    <?php $total = 0; $lunas = 0 ?>
                        <!--<button class="badge badge-success" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_penjualan}}" style="width:80px;margin:5px">Tambah</button>-->
                        <button class="badge badge-info" data-toggle="modal" data-target="#modalDetail{{$p->id_penjualan}}" style="width:80px;margin:5px">List</button>
                        <hr/>Total : {{ number_format($p->total) }}
                        <div class="modal fade" id="modalDetail{{$p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} -  Barang</h5>
                                    </div>
                                    <div class="modal-body">
                                        <button class="badge badge-success" data-dismiss="modal" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_penjualan}}" style="width:80px;margin:5px">Tambah</button><hr/>
                                        <table id="t">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $countb = 0 ?>
                                            @foreach($p->barang as $b)
                                            <tr>
                                                <?php $countb = $countb+1 ?>
                                                <td>{{$countb}}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->pivot->jumlah_barang }}</td>
                                                <td>{{ number_format($b->pivot->harga_barang) }}</td>
                                                <td>{{ number_format($b->pivot->total_harga_barang) }}</td>
                                                <td><button class="badge badge-info" data-toggle="modal" data-target="#editModalDetail{{$p->id_penjualan}}_{{$b->id_barang}}">Edit</button></td>
                                                <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                            </tr>
                                            <!-- Modal Edit Detail -->
                                            <div class="modal fade" id="editModalDetail{{$p->id_penjualan}}_{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} - {{$b->id_barang}}  -  Edit Barang</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form autocomplete="off" method="post" action="{{ url('/penjualan/detail/update/'.$p->id_penjualan.'/'.$b->id_barang) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p->id_penjualan }}">
                                                                <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="view">Barang</label>
                                                                        <input type="text" class="form-control" id ="view" name="view" value="{{$b->id_barang}} - {{$b->nama_barang}}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="stok_barang">Stok</label>
                                                                        <input type="number" class="form-control" id ="stok_be" name="stok_e" value="{{$b->stok}}" disabled>
                                                                        <input type="number" class="form-control" id ="stok_barange" name="stok_barange" value="{{$b->stok}}" hidden>
                                                                        <input type="number" class="form-control" id ="stok_jumlah" name="stok_jumlah" value="{{ $b->pivot->jumlah_barang }}" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="harga_barang">Harga</label>
                                                                        <input type="number" class="form-control" id ="harga_barang" name="harga_barang" value="{{ $b->pivot->harga_barang }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="jumlah_barang">Jumlah</label>
                                                                        <input type="number" class="form-control" id ="jumlah_barang" name="jumlah_barang" value="{{ $b->pivot->jumlah_barang }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </br>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php $lunas = ($p->total) ?>
                    @foreach($p->pembayaran as $pb)
                        <?php $lunas = $lunas - ($pb->jumlah_bayar) ?>
                    @endforeach
                    <td>
                    @if($lunas == $p->total)
                        <button class="badge badge-danger" data-toggle="modal" data-target="#modalPembayaran{{$p->id_penjualan}}" style="width:120px;margin:5px">Pembayaran</button>
                    @elseif($lunas == 0)
                        <button class="badge badge-success" data-toggle="modal" data-target="#modalPembayaran{{$p->id_penjualan}}" style="width:120px;margin:5px">Pembayaran</button>
                    @else
                        <button class="badge badge-secondary" data-toggle="modal" data-target="#modalPembayaran{{$p->id_penjualan}}" style="width:120px;margin:5px">Pembayaran</button>
                    @endif
                    <div class="modal fade" id="modalPembayaran{{$p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width:100%;max-width:800px" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} -  Pembayaran</h5>
                                    </div>
                                    <div class="modal-body">
                                        <button class="badge badge-success" data-dismiss="modal" data-toggle="modal" data-target="#tambahModalPembayaran{{$p->id_penjualan}}" style="width:80px;margin:5px">Tambah</button><hr/>
                                        <table id="t">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID</th>
                                                    <th>Tgl Pembayaran</th>
                                                    <th>Jumlah Pembayaran</th>
                                                    <th>Keterangan</th>
                                                    <th>Tgl Diperbarui</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $countpb = 0 ?>
                                            @foreach($p->pembayaran as $pb)
                                            <tr>
                                                <?php $countpb = $countpb+1 ?>
                                                <td>{{$countpb}}</td>
                                                <td>{{ $pb->id_pembayaran}}</td>
                                                <td>{{ \Carbon\Carbon::parse($pb->tgl_pembayaran)->format('d M Y') }}</td>
                                                <td>{{ number_format($pb->jumlah_bayar) }}</td>
                                                <td>{{ $pb->keterangan }}</td>
                                                <td>{{ $pb->timestamp }}</td>
                                                <td><button class="badge badge-info" data-toggle="modal" data-target="#editModalPembayaran{{$pb->id_pembayaran}}">Edit</button></td>
                                                <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                            </tr>
                                            <!-- Modal Edit Pembayaran -->
                                            <div class="modal fade" id="editModalPembayaran{{$pb->id_pembayaran}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="width:100%;max-width:800px" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{$pb->id_pembayaran}}  -  Edit Pembayaran</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form autocomplete="off" method="post" action="{{ url('/pembayaran/update/'.$p->id_penjualan.'/'.$pb->id_pembayaran) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p->id_penjualan }}">
                                                            <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                                            <div class="form-group">
                                                                <label for="tgl_pembayaran">Tanggal</label>
                                                                <input type="date" class="form-control" id ="tgl_pembayaran" name="tgl_pembayaran" value="{{ $pb->tgl_pembayaran }}">
                                                            </div>
                                                            <div class="form-group">
                                                                    <label for="jumlah_bayar">Jumlah pembayaran</label>
                                                                    <input type="number" class="form-control" id ="jumlah_bayar" name="jumlah_bayar" value="{{ $pb->jumlah_bayar }}">
                                                                </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control" id ="keterangan" name="keterangan" value="{{ $pb->keterangan }}">
                                                            </div>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </br>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr/>Total Terbayar : {{ number_format($p->total - $lunas) }}
                    </td>
                    <td>{{$lunas}}</td>
                    <td>{{$p->timestamp}}</td>
                    <td style="width"><a href="{{ url('/penjualan/cetak/'.$p->id_penjualan) }}"><button class="badge badge-success" style="width:80px;margin:5px">Cetak</button><a>
                    <br/><button class="badge badge-info" style="width:80px;margin:5px" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}">Edit</button></td>
                </tr>
                <!-- Modal Tambah Detail -->
                <div class="modal fade" id="tambahModalDetail{{$p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} - Tambah Barang</h5>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off" method="post" action="{{ url('/penjualan/detail/store/'.$p->id_penjualan) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p->id_penjualan }}">
                                <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="id_barang">ID Barang</label>
                                            <input type="text" class="form-control" name="id_barang" id ="id_barang" list="barang">
                                            <datalist id="barang">
                                                @foreach($barang as $brg)
                                                <option value="{{$brg->id_barang}}" hrg="{{$brg->harga_sementara}}" stk="{{$brg->stok}}">{{$brg->nama_barang}}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="stok_barang">Stok</label>
                                            <input type="number" class="form-control" id ="stok_b" name="stok_b" disabled>
                                            <input type="number" class="form-control" id ="stok_barang" name="stok_barang" hidden>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="harga_barang">Harga</label>
                                            <input type="number" class="form-control" id ="harga_barang" name="harga_barang">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jumlah_barang">Jumlah</label>
                                            <input type="number" class="form-control" id ="jumlah_barang" name="jumlah_barang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah Pembayaran -->
                <div class="modal fade" id="tambahModalPembayaran{{ $p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:100%;max-width:800px" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$p->id_penjualan}}  -  Tambah Pembayaran</h5>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off" method="post" action="{{ url('/pembayaran/store/'.$p->id_penjualan) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p->id_penjualan }}">
                                <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                <div class="form-group">
                                    <label for="tgl_pembayaran">Tanggal</label>
                                    <input type="date" class="form-control" id ="tgl_pembayaran" name="tgl_pembayaran" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group">
                                        <label for="jumlah_bayar">Jumlah pembayaran</label>
                                        <input type="number" class="form-control" id ="jumlah_bayar" name="jumlah_bayar">
                                    </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id ="keterangan" name="keterangan">
                                </div>
                            </div>
                            </br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} - Edit Data Penjualan</h5>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off" method="post" action="{{ url('/penjualan/update/'.$p->id_penjualan) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="id_pelanggan">ID Pelanggan</label>
                                    <input type="text" class="form-control" name="id_pelanggan" id ="id_pelanggan" list="pelanggan2" value="{{ $p->id_pelanggan }}">
                                    <datalist id="pelanggan2">
                                        @foreach($pelanggan as $pgn)
                                        <option value="{{$pgn->id_pelanggan}}">{{$pgn->nama_pelanggan}}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_penjualan">Tanggal</label>
                                    <input type="date" class="form-control" id ="tgl_penjualan" name="tgl_penjualan" value="{{ $p->tgl_penjualan }}">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id ="keterangan" name="keterangan" value="{{ $p->keterangan }}">
                                </div>
                            </div>
                            </br>
                            <div class="modal-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
	</div>
</body>
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penjualan</h5>
            </div>
            <div class="modal-body">
                <form autocomplete="off" method="post" action="{{ url('/penjualan/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="id_pelanggan">ID Pelanggan</label>
                    <input type="text" class="form-control" name="id_pelanggan" id ="id_pelanggan" list="pelanggan">
                    <datalist id="pelanggan">
                        @foreach($pelanggan as $pgn)
                        <option value="{{$pgn->id_pelanggan}}">{{$pgn->nama_pelanggan}}, {{$pgn->alamat_pelanggan}}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group">
                    <label for="tgl_penjualan">Tanggal</label>
                    <input type="date" class="form-control" id ="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id ="keterangan" name="keterangan">
                </div>
            </div>
            </br>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
                
@endsection
@section('script')
<script type="text/javascript">
   
	$(document).ready( function () {
        $('#t').DataTable();
    } );
    
    $('#id_barang').on('change', function(){
        var value = $(this).val();
        var harga = $('#barang [value="' + value + '"]').attr('hrg');
        var stokb = $('#barang [value="' + value + '"]').attr('stk');
        console.log(harga);
        $('#stok_barang').val(stokb);
        $('#stok_b').val(stokb);
        $('#harga_barang').val(harga);
    })
    
    // init
    $('#id_barang').change();
</script>
@endsection