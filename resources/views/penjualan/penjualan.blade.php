@extends('layout/master')
@section('title','Penjualan')
@section('css')
    <style>
        td{
            vertical-align: top;
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
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>List</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th>Diperbarui</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($penjualan as $p)
                <tr>
                    <td>{{$p->id_penjualan}}</td>
                    <td>{{$p->pelanggan->id_pelanggan}} - {{$p->pelanggan->nama_pelanggan}}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_penjualan)->format('d M Y')}}</td>
                    <td style="width:30%">
                        <?php $total = 0 ?>
                        @foreach($p->barang as $b)
							<li>{{ $b->nama_barang }} | Harga : {{ $b->pivot->harga_barang }}
                            <br/>&emsp;&ensp;Jumlah : {{ $b->pivot->jumlah_barang }}
                            <br/>&emsp;&ensp;Sub total : {{ $b->pivot->jumlah_barang * $b->pivot->harga_barang }}</li>
                        <?php $total += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
						@endforeach
                    </td>
                    <td style="text-align:right">{{ $total }}</td>
                    <td>{{$p->keterangan}}</td>
                    <td>{{$p->timestamp}}</td>
                    <td><a href="{{ url('/penjualan/cetak/'.$p->id_penjualan) }}"><button class="badge badge-success">Cetak</button><a>
                    &nbsp;<button class="badge badge-info" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}">Edit</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
	</div>
</body>
                <!-- Modal Edit -->
                
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready( function () {
        $('#t').DataTable();
    } );
</script>
@endsection