@extends('layout/master')
@section('title','Laporan')
@section('css')
<style>
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
        <script>window.location = "/";</script>
    @elseif(Auth::user()->role == 1)
    <body>
                
            <div class="container">
                
                    <br/>
                    <h1>Laporan</h1>
                <br/>
                <br/>
                @foreach($laporan as $l)
                <form autocomplete="off" method="post" action="{{ url('/laporan/update/'.$l->id_laporan) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tgl_awal">Tgl Awal</label>
                                <input type="date" class="form-control" id ="tgl_awal" name="tgl_awal" value="{{ $l->tgl_awal }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tgl_akhir">Tgl Akhir</label>
                                <input type="date" class="form-control" id ="tgl_akhir" name="tgl_akhir" value="{{ $l->tgl_akhir }}">
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                </form>
                <hr/>
                @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="t" class="display cell-border">
                        <thead>
                            <tr style="background-color:#BDDFFF">
                                <th>No</th>
                                <th>Penjualan</th>
                                <th>Pembayaran</th>
                                <th>Pengiriman</th>
                                <th>Pengadaan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="background-color:#BDDFEE">
                                <th>No</th>
                                <th>Penjualan</th>
                                <th>Pembayaran</th>
                                <th>Pengiriman</th>
                                <th>Pengadaan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($laporan as $l)
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <button class="badge badge-info" data-toggle="modal" data-target="#modalPenjualan" style="margin:5px">Penjualan</button>
                                        <!-- Modal Penjualan -->
                                        <div class="modal fade" id="modalPenjualan" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"  role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Laporan Penjualan</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="" class="tpj">
                                                            <thead>
                                                                <tr style="background-color:#BDDFFF">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr style="background-color:#BDDFEE">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                            <?php $countpj = 0 ; $tot = 0 ?>
                                                            @foreach($penjualan as $p)
                                                            @if($p->pemesanan == 0 || $p->pemesanan == null)
                                                            <tr>
                                                                <?php 
                                                                    $countpj = $countpj+1;
                                                                    $tot = $tot+$p->total;
                                                                ?>
                                                                <td>{{$countpj}}</td>
                                                                <td>{{ $p->id_penjualan}}</td>
                                                                <td>{{ $p->pelanggan->nama_pelanggan }}</td>
                                                                <td>{{ $p->tgl_penjualan }}</td>
                                                                <td>{{ number_format($p->total) }}</td>
                                                                <!-- <td>{{ ($p->keterangan) }}</td> -->
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4" style="text-align:right">Total :</td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td>{{number_format($tot)}}</td>
                                                            </tr>
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
                                    <td>
                                        <button class="badge badge-info" data-toggle="modal" data-target="#modalPembayaran" style="margin:5px">Pembayaran</button>
                                        <!-- Modal Pembayaran -->
                                        <div class="modal fade" id="modalPembayaran" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"  role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Laporan Pembayaran</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="" class="tpb">
                                                            <thead>
                                                                <tr style="background-color:#BDDFFF">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>ID Penjualan</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr style="background-color:#BDDFEE">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>ID Penjualan</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                            <?php $countpb = 0 ; $totpb = 0 ?>
                                                            @foreach($pembayaran as $p)
                                                            <tr>
                                                                <?php 
                                                                    $countpb = $countpb+1;
                                                                    $totpb = $totpb+$p->jumlah_bayar;
                                                                ?>
                                                                <td>{{$countpb}}</td>
                                                                <td>{{ $p->id_pembayaran}}</td>
                                                                <td>{{ $p->penjualan->id_penjualan}}</td>
                                                                <td>{{ $p->penjualan->pelanggan->nama_pelanggan }}</td>
                                                                <td>{{ $p->tgl_pembayaran }}</td>
                                                                <td>{{ number_format($p->jumlah_bayar) }}</td>
                                                                <!-- <td>{{ ($p->keterangan) }}</td> -->
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="5" style="text-align:right">Total Terbayar :</td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td>{{number_format($totpb)}}</td>
                                                            </tr>
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
                                    <td>
                                        <button class="badge badge-info" data-toggle="modal" data-target="#modalPengiriman" style="margin:5px">Pengiriman</button>
                                        <!-- Modal Pengiriman -->
                                        <div class="modal fade" id="modalPengiriman" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"  role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Laporan Pengiriman</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="" class="tpr">
                                                            <thead>
                                                                <tr style="background-color:#BDDFFF">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>ID Penjualan</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr style="background-color:#BDDFEE">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>ID Penjualan</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                            <?php $countpr = 0 ; $jml = 0 ?>
                                                            @foreach($pengiriman as $p)
                                                            <tr>
                                                                <?php 
                                                                    $countpr = $countpr+1;
                                                                    //$jml = $jml+$p->jumlah;
                                                                ?>
                                                                <td>{{$countpr}}</td>
                                                                <td>{{ $p->id_pengiriman}}</td>
                                                                <td>{{ $p->penjualan->id_penjualan}}</td>
                                                                <td>{{ $p->penjualan->pelanggan->nama_pelanggan }}</td>
                                                                <td>{{ $p->tgl_pengiriman }}</td>
                                                                <!-- <td>{{ ($p->keterangan) }}</td> -->
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
                                    <td>
                                        <button class="badge badge-info" data-toggle="modal" data-target="#modalPengadaan" style="margin:5px">Pengadaan</button>
                                        <!-- Modal Pengadaan -->
                                        <div class="modal fade" id="modalPengadaan" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"  role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Laporan Pengadaan</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="" class="tpg">
                                                            <thead>
                                                                <tr style="background-color:#BDDFFF">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>Pemasok</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr style="background-color:#BDDFEE">
                                                                    <th>No</th>
                                                                    <th>ID</th>
                                                                    <th>Pemasok</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Total</th>
                                                                    <!-- <th>Keterangan</th> -->
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                            <?php $countpg = 0 ; $totpg = 0 ?>
                                                            @foreach($pengadaan as $p)
                                                            <tr>
                                                                <?php 
                                                                    $countpg = $countpg+1;
                                                                    $totpg = $totpg+$p->total;
                                                                ?>
                                                                <td>{{$countpg}}</td>
                                                                <td>{{ $p->id_pengadaan}}</td>
                                                                <td>{{ $p->pemasok->nama_pemasok }}</td>
                                                                <td>{{ $p->tgl_pengadaan }}</td>
                                                                <td>{{ number_format($p->total) }}</td>
                                                                <!-- <td>{{ ($p->keterangan) }}</td> -->
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4" style="text-align:right">Total :</td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td style="display: none;"></td>
                                                                <td>{{number_format($totpg)}}</td>
                                                            </tr>
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
                                </tr>
                            @endforeach
                                <tr>
                                    <td>2</td>
                                    <td colspan="2" style="text-align:center">Terhutang : {{number_format($tot - $totpb)}}</td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td colspan="4" style="text-align:center">Penjualan - Pengadaan : {{number_format($tot - $totpg)}}</td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>
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
        $('table.tpj tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('table.tpj').DataTable({
            dom: 'Bfrtip',
            // buttons: ['excel'],
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print',],
            buttons: [
                {
                    extend: 'excel',
                    title: 'Laporan Penjualan',
                    filename: 'Laporan Penjualan'
                },
                {
                    extend: 'pdf',
                    title: 'Laporan Penjualan',
                    filename: 'Laporan Penjualan',
                    pageSize: 'A5'
                }
            ],
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
        $('table.tpb tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('table.tpb').DataTable({
            dom: 'Bfrtip',
            // buttons: ['excel'],
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print',],
            buttons: [
                {
                    extend: 'excel',
                    title: 'Laporan Pembayaran',
                    filename: 'Laporan Pembayaran'
                },
                {
                    extend: 'pdf',
                    title: 'Laporan Pembayaran',
                    filename: 'Laporan Pembayaran',
                    pageSize: 'A5'
                }
            ],
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
        $('table.tpr tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('table.tpr').DataTable({
            dom: 'Bfrtip',
            // buttons: ['excel'],
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print',],
            buttons: [
                {
                    extend: 'excel',
                    title: 'Laporan Pengiriman',
                    filename: 'Laporan Pengiriman'
                },
                {
                    extend: 'pdf',
                    title: 'Laporan Pengiriman',
                    filename: 'Laporan Pengiriman',
                    pageSize: 'A5'
                }
            ],
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
        $('table.tpg tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('table.tpg').DataTable({
            dom: 'Bfrtip',
            // buttons: ['excel'],
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print',],
            buttons: [
                {
                    extend: 'excel',
                    title: 'Laporan Pengadaan',
                    filename: 'Laporan Pengadaan'
                },
                {
                    extend: 'pdf',
                    title: 'Laporan Pengadaan',
                    filename: 'Laporan Pengadaan',
                    pageSize: 'A5'
                }
            ],
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

</script>
@endsection