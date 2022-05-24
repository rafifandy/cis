<html>
@foreach($penjualan as $p)
<head>
    <h2><font face="" size="5">Toko Rahayu Bahan Kue dan </font></h2>
    <h2><font face="" size="5">Bahan Makanan Kemasan</font></h2>
    <h4><font face="Courier New">Surabaya, 081357993720</font></h4>
    <body>
        <font face="Courier New"/>



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
            <td style="width:200px">{{$b->nama_barang}}</td><td></td>
            <td style="padding-right:40px;text-align:right">{{number_format($b->pivot->total_harga_barang)}}</td>
            </tr>

            <tr>
            <td>{{number_format($b->pivot->harga_barang)}}</td><td>x</td>
            <td>{{$b->pivot->jumlah_barang}}</td>
            </tr>
            @endforeach

            <td colspan="4">------------------------------------------------------ (*)</td>

            <tr>
            <td>Total Harga</td><td>:</td>
            <td style="padding-right:40px;text-align:right">{{number_format($p->total)}}</td>
            </tr>

            <?php $countpb = 0; $totalpb = 0 ?>
            @foreach($p->pembayaran as $pb)
                <?php $countpb++; ?>
                <?php $totalpb = $totalpb + $pb->jumlah_bayar; ?>
            @endforeach

            @if($countpb == 0)
            <!--<td colspan="4">------------------------------------------------------</td>-->
            @elseif($countpb == 1)
                @foreach($p->pembayaran as $pb)
                <tr>
                <td>Total Pembayaran</td><td>:</td>
                <td style="padding-right:40px;text-align:right">{{number_format($pb->jumlah_bayar)}}</td>
                </tr>
                <td colspan="4">------------------------------------------------------ (-)</td>
                    @if($p->total - $pb->jumlah_bayar != 0)
                    <tr>
                    <td>Belum Terbayar</td><td>:</td>
                    <td style="padding-right:40px;text-align:right">{{number_format($p->total - $pb->jumlah_bayar)}}</td>
                    </tr>
                    @endif
                @endforeach
            @else
                <?php $count = 0; $total = 0; ?>
                @foreach($p->pembayaran as $pb)
                <?php $count++; ?>
                <tr>
                <td>Total Pembayaran ke {{$count}}</td><td>:</td>
                <td style="padding-right:40px;text-align:right">{{number_format($pb->jumlah_bayar)}}</td>
                </tr>
                <?php $total = $total + $pb->jumlah_bayar; ?>
                @endforeach
                    @if($p->total - $total != 0)
                    <td colspan="4">------------------------------------------------------ (-)</td>
                    <tr>
                    <td>Belum Terbayar</td><td>:</td>
                    <td style="padding-right:40px;text-align:right">{{number_format($p->total - $total)}}</td>
                    </tr>
                    @else
                    <tr></tr>
                    @endif
            @endif






<td colspan="4">------------------------------------------------------</td>

<tr>
<td></br><a href="form_cat.php">Kembali</a></td>
</tr>

</table>
</body>
@endforeach
</html>