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
                    <th>No</th>
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
            <?php $count = 0 ?>
            @foreach($penjualan as $p)
                <tr>
                    <?php $count = $count+1 ?>
                    <td>{{$count}}</td>
                    <td>{{$p->id_penjualan}}</td>
                    <td>{{$p->pelanggan->id_pelanggan}} - {{$p->pelanggan->nama_pelanggan}}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_penjualan)->format('d M Y')}}</td>
                    <td style="font-size:12px">
                        <?php $total = 0 ?>
                        <table id="t">
                        <thead>
                            <tr style="background-color:white">
                                <th>Jumlah</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($p->barang as $b)
                            <tr>
                                <td style="font-size:11px">{{ $b->pivot->jumlah_barang }}</td>
                                <td style="font-size:11px">{{ $b->nama_barang }}</td>
                                <td style="font-size:11px">{{ number_format($b->pivot->harga_barang) }}</td>
                                <td style="font-size:11px">{{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</td>
                                <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                <?php $total += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td style="text-align:right">{{ number_format($total) }}</td>
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