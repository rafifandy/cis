<html>
<head>
<title>Nota Pembelian</title>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
@foreach($penjualan as $p)
<center>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:12pt'><b>Toko Rahayu</b></span></br>
<p>Jl Bratang Gede VI-E/10</p>
<p>Telp : 081357993720</p>
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>Nota Pembelian</span></b></br>
<p>ID Pembelian : {{$p->id_penjualan}}</p>
<p>Tanggal : {{ \Carbon\Carbon::parse($p->tgl_penjualan)->format('d M Y') }}</p>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<p>Nama Customer : {{$p->pelanggan->nama_pelanggan}}</p>
<p>Alamat : {{$p->pelanggan->alamat_pelanggan}}</p>
</td>
<td style='vertical-align:top' width='30%' align='left'>
<p>No Telp : {{$p->pelanggan->no_telp_pelanggan}}</p></td>
</table>
<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='7%'></td>
<td width='13%'>Total Harga</td>
@foreach($p->barang as $b)
<tr><td>{{$b->id_barang}}</td>
<td>{{$b->nama_barang}}</td>
<td>Rp {{number_format($b->pivot->harga_barang)}}</td>
<td>{{($b->pivot->jumlah_barang)}}</td>
<td></td>
<td style='text-align:right'>Rp {{number_format($b->pivot->total_harga_barang)}}</td>
 
<tr>
@endforeach
<td colspan = '5'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
<td style='text-align:right'>Rp {{number_format($p->total_akhir)}}</td>
</tr>
<tr>
</tr>
<tr>
<?php $lunas = ($p->total_akhir) ?>
@foreach($p->pembayaran as $pb)
    <?php $lunas = $lunas - ($pb->jumlah_bayar) ?>
@endforeach
<td colspan = '5'><div style='text-align:right'>Terbayar : </div></td>
<td style='text-align:right'>Rp {{number_format($p->total_akhir - $lunas)}}</td>
</tr>
<!-- <tr>
<td colspan = '5'><div style='text-align:right'>Kembalian : </div></td><td style='text-align:right'>Rp0,00</td>
</tr>
<tr>
<td colspan = '5'><div style='text-align:right'>DP : </div></td>
<td style='text-align:right'>Rp0,00</td>
</tr> -->
<tr>
<td colspan = '5'><div style='text-align:right'>Sisa : </div></td>
<td style='text-align:right'>Rp {{number_format($lunas)}}</td></tr>
</table>
 
<table style='width:450; font-size:7pt;' cellspacing='2'>
<tr>
<td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
<td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td>
<td align='center'>TTD,</br></br><u>(...........)</u></td>
</tr>
</table>
</center>
@endforeach
</body>
</html>