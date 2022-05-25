@extends('layout/master')
@section('title','Rekap')
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
		<h1>Rekap</h1>
	</center>
	<br/>
	<br/>
    <div class="container">
        <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Rekap Baru</button><hr/>
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
                    <th>Nama Rekap</th>
                    <th>Dari</th>
                    <th>Sampai</th>
                    <th>Total Penjualan</th>
                    <th>Total Pengadaan</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0 ?>
            @foreach($rekap as $r)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$r->id_rekap}}</td>
                    <td>{{$r->nama_rekap}}</td>
                    <td>{{ \Carbon\Carbon::parse($r->tgl_awal)->format('d M Y')}}</td>
                    <td>{{ \Carbon\Carbon::parse($r->tgl_akhir)->format('d M Y')}}</td>
                    <?php $totalpj = 0 ?>
                    @foreach($penjualan as $pj)
                        @if($pj->tgl_penjualan >= $r->tgl_awal && $pj->tgl_penjualan <= $r->tgl_akhir)
                        <?php $totalpjb = 0 ?>
                        @foreach($pj->barang as $b)
                            <?php $totalpjb += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
                        @endforeach
                        <?php $totalpj += $totalpjb ?>
                        @endif
                    @endforeach
                    <td style="text-align:right">{{ number_format($totalpj) }}</td>
                    <?php $totalpg = 0 ?>
                    @foreach($pengadaan as $pg)
                        @if($pg->tgl_pengadaan >= $r->tgl_awal && $pg->tgl_pengadaan <= $r->tgl_akhir)
                        <?php $totalpgb = 0 ?>
                        @foreach($pg->barang as $b)
                            <?php $totalpgb += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
                        @endforeach
                        <?php $totalpg += $totalpgb ?>
                        @endif
                    @endforeach
                    <td style="text-align:right">{{ number_format($totalpg) }}</td>
                    <td style="text-align:right">{{ number_format($totalpj - $totalpg) }}</td>
                    <td>{{$r->keterangan}}</td>
                    <td>{{$r->timestamp}}</td>
                    <td style="width:12%"><button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$r->id_rekap}}">Edit</button></td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$r->id_rekap}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $r->id_rekap }} - Edit Data</h5>
                            </div>
                                    <div class="modal-body">
                                    <form autocomplete="off" method="post" action="{{ url('/rekap/update/'.$r->id_rekap) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_rekap">Nama</label>
                                        <input type="text" class="form-control" id ="nama_rekap" name="nama_rekap" value="{{ $r->nama_rekap }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_awal">Dari</label>
                                        <input type="date" class="form-control" id ="tgl_awal" name="tgl_awal" value="{{ $r->tgl_awal }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_akhir">Sampai</label>
                                        <input type="date" class="form-control" id ="tgl_akhir" name="tgl_akhir" value="{{ $r->tgl_akhir }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id ="keterangan" name="keterangan" value="{{ $r->keterangan }}">
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
                    <form autocomplete="off" method="post" action="{{ url('/rekap/store') }}" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
                            <label for="nama_rekap">Nama</label>
                            <input type="text" class="form-control" id ="nama_rekap" name="nama_rekap">
                        </div>
                        <div class="form-group">
                            <label for="tgl_awal">Dari</label>
                            <input type="date" class="form-control" id ="tgl_awal" name="tgl_awal">
                        </div>
                        <div class="form-group">
                            <label for="tgl_akhir">Sampai</label>
                            <input type="date" class="form-control" id ="tgl_akhir" name="tgl_akhir">
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
</script>
@endsection