<html>
@foreach($penjualan as $p)
<head>
<h2><font face="" size="5">Toko Rahayu Bahan Kue dan </font></h2>
<h2><font face="" size="5">Bahan Makanan Kemasan</font></h2>
<h4><font face="Courier New">Surabaya, 081357993720</font></h4>
<body>
<font face="Courier New"/>

<?php
$cat = "CATYLAC";
$beli = 5;
?>

<table>

<td colspan="4">------------------------------------------------------</td>

<tr>
<td>{{ ($p->tgl_penjualan) }}</td><td></td>
<td></td>
</tr>

<tr>
<td>ID</td><td>:</td>
<td>{{ ($p->id_penjualan) }}</td>
</tr>

@if($p->pelanggan->id_pelanggan != 1)
<tr>
<td>Nama Costumer</td><td>:</td>
<td>{{ ($p->pelanggan->nama_pelanggan) }}</td>
</tr>

<tr>
<td>Alamat</td><td>:</td>
<td>{{ ($p->pelanggan->alamat_pelanggan) }}</td>
</tr>
@endif

<td colspan="4">------------------------------------------------------</td>

    @foreach($p->barang as $b)
    <tr>
    <td style="width:250px">{{$b->nama_barang}}</td><td></td>
    <td style="padding-left: 180px">{{$b->pivot->total_harga_barang}}</td>
    </tr>

    <tr>
    <td>{{$b->pivot->harga_barang}}</td><td>x</td>
    <td>{{$b->pivot->jumlah_barang}}</td>
    </tr>
    @endforeach
<td colspan="4">------------------------------------------------------ (*)</td>

<tr>
<td>Total Harga</td><td>:</td>
<td style="padding-left: 180px">{{$p->total}}</td>
</tr>

<td colspan="4">------------------------------------------------------ (-)</td>

<tr>
</tr>

<td colspan="4">------------------------------------------------------</td>

<tr>
<td></br><a href="form_cat.php">Kembali</a></td>
</tr>

</table>
</body>
@endforeach
</html>