@extends('layout/master')
@section('title','Pemesanan')
@section('css')
<style>
    td{
        vertical-align: top;
        font-size: 13px;
    }
    th{
        font-size: 14px;
    }
    /* col search */
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    tfoot {
        display: table-header-group;
    }
</style>
@endsection
@section('content')
@guest
    <script>window.location = "/";</script>
@else
    @if(Auth::user()->role != 1)
        <script>window.location = "/cpemesanan";</script>
    @elseif(Auth::user()->role == 1)
        <body>
                
            <div class="container">
                
                <br/>
                <h2>Pemesanan</h2>
                <p>Pemesanan yang belum disubmit oleh pelanggan</p>
            <br/>
            <br/>
                <a href="{{ url('/apemesanan') }}"><button class="badge badge-info">Kembali</button></a><hr/>
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
                            <th>Keterangan</th>
                            <th>Tgl Diperbarui</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="background-color:#BDDFEE">
                            <th>No</th>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>List Barang</th>
                            <th>Keterangan</th>
                            <th>Tgl Diperbarui</th>
                        </tr>
                    </tfoot>
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
                                <hr/>Total : {{ number_format($p->total_akhir) }}
                                <!-- Modal List Barang -->
                                <div class="modal fade" id="modalDetail{{$p->id_penjualan}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg"  role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_penjualan }} -  Barang</h5>
                                            </div>
                                            <div class="modal-body">
                                                <table id="t2">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </tfoot>
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
                                                        <!-- <li>{{ $b->pivot->jumlah_barang }} | {{ $b->nama_barang }} | {{ number_format($b->pivot->harga_barang) }} | {{ number_format($b->pivot->jumlah_barang * $b->pivot->harga_barang) }}</li> -->
                                                        <?php //$total += ($b->pivot->total_harga_barang) ?>
                                                    </tr>
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
                            <td>{{$p->keteragan}}</td>
                            <td>{{$p->timestamp}}</td>
                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </body>
    @endif
@endguest           
@endsection
@section('script')
<script type="text/javascript">
   
   $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#t tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('#t').DataTable({
            //dom: 'Bfrtip',
            //buttons: ['excel'],
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;
    
                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });
    });

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#t2 tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('#t2').DataTable({
            //dom: 'Bfrtip',
            //buttons: ['excel'],
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;
    
                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });
    });  
    
    // init
    $('#id_barang').change();
</script>
@endsection