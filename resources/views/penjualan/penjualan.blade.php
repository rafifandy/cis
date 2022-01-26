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
                    <td style="font-size:12px">
                        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_penjualan}}" style="font-size:10px">Tambah</button><hr/>
                        <?php $total = 0 ?>
                        <table id="t">
                        <thead>
                            <tr style="background-color:white">
                                <th style="font-size:11px">Barang</th>
                                <th style="font-size:11px">Jumlah</th>
                                <th style="font-size:11px">Harga</th>
                                <th style="font-size:11px">Subtotal</th>
                                <th style="font-size:11px">Opsi</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($p->barang as $b)
                            <tr>
                                <td style="font-size:11px">{{ $b->nama_barang }}</td>
                                <td style="font-size:11px">{{ $b->pivot->jumlah_barang }}</td>
                                <td style="font-size:11px">{{ number_format($b->pivot->harga_barang) }}</td>
                                <td style="font-size:11px">{{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</td>
                                <td style="font-size:11px"><button class="badge badge-info" data-toggle="modal" data-target="#editModalDetail{{$p->id_penjualan}}_{{$b->id_barang}}" style="font-size:10px">Edit</button></td>
                                <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                <?php $total += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
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
                                                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td style="text-align:right">{{ number_format($total) }}</td>
                    <td>{{$p->keterangan}}</td>
                    <td>{{$p->timestamp}}</td>
                    <td style="width:12%"><a href="{{ url('/penjualan/cetak/'.$p->id_penjualan) }}"><button class="badge badge-success">Cetak</button><a>
                    &nbsp;<button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}">Edit</button></td>
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