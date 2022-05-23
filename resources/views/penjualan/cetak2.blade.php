<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Penjualan</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
@foreach($penjualan as $p)
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title" style="font-size:36px">
                                Nota Pembelian
                            </td>

                            <td>
                                id : {{$p->id_penjualan}}<br>
                                {{ \Carbon\Carbon::parse($p->tgl_penjualan)->format('d M Y')}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Jl. Bratang Gede VI-E/10<br>
                                60245 Ngagelrejo, Wonokromo<br>
                                Surabaya<br><br><br>
                                Pembeli : {{$p->pelanggan->nama_pelanggan}}
                            </td>

                            <td>
                                Toko Rahayu<br>
                                Karyono<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Barang</td>
                <td style="text-align:right">Harga satuan</td>
                <td style="text-align:right">Jumlah</td>
                <td style="text-align:right">Sub total</td>
            </tr>
            <?php $total = 0 ?>
            @foreach($p->barang as $b)
            <tr class="item">
                <td>{{$b->nama_barang}}</td>
                <td style="text-align:right">{{number_format($b->pivot->harga_barang)}}</td>
                <td style="text-align:right">{{$b->pivot->jumlah_barang}}</td>
                <td style="text-align:right">{{number_format($b->pivot->harga_barang * $b->pivot->jumlah_barang)}}</td>
            </tr>
            <?php $total += ($b->pivot->harga_barang * $b->pivot->jumlah_barang) ?>
            @endforeach

            <tr class="total">
                <td></td>
                <td></td>
                <td style="text-align:right">Total : </td>
                <td style="text-align:right">{{ number_format($total) }}</td>
            </tr>
        </table>
    </div>
@endforeach
</body>
</html>