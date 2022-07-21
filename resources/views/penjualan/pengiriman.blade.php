@extends('layout/master')
@section('title','Pengiriman')
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
        <script>window.location = "/";</script>
    @elseif(Auth::user()->role == 1)
        <body>
                
            <div class="container">
                
                <br/>
                <h1>Pengiriman</h1>
            <br/>
            <br/>
                <button class="badge badge-success" data-toggle="modal" data-target="#tambahModal">Pengiriman Baru</button><hr/>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach($penjualan as $pj)
                    <?php $id_pj = $pj->id_penjualan?>
                @endforeach
                @foreach($pelanggan as $plg)
                    <?php $nama_plg = $plg->nama_pelanggan?>
                @endforeach
                <p style="font-size:14px">ID Penjualan : {{$id_pj}}</p><br/>
                <p style="font-size:14px">Nama Pelanggan : {{$nama_plg}}</p><br/>
                <table id="" class="t display cell-border">
                    <thead>
                        <tr style="background-color:#BDDFFF">
                            <th>No</th>
                            <th>ID</th>
                            <th>Tgl Pengiriman</th>
                            <th>Alamat Tujuan</th>
                            <th>List Barang</th>
                            <th>Keterangan</th>
                            <th>Tgl Diperbarui</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="background-color:#BDDFEE">
                            <th>No</th>
                            <th>ID</th>
                            <th>Tgl Pengiriman</th>
                            <th>Alamat Tujuan</th>
                            <th>List Barang</th>
                            <th>Keterangan</th>
                            <th>Tgl Diperbarui</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php $count = 0 ?>
                    @foreach($pengiriman as $p)
                        <tr>
                            <?php $count = $count+1 ?>
                            <td>{{$count}}</td>
                            <td>{{$p->id_pengiriman}}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_pengiriman)->format('d M Y')}}</td>
                            <td>{{$p->alamat_tujuan}}</td>
                            <td style="">
                            <?php $total = 0; $lunas = 0 ?>
                                <!--<button class="badge badge-success" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_penjualan}}" style="width:80px;margin:5px">Tambah</button>-->
                                <button class="badge badge-info" data-toggle="modal" data-target="#modalDetail{{$p->id_pengiriman}}" style="width:80px;margin:5px">List</button>
                                <hr/>
                                <div class="modal fade" id="modalDetail{{$p->id_pengiriman}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_pengiriman }} -  Barang</h5>
                                            </div>
                                            <div class="modal-body">
                                                <button class="badge badge-success" data-dismiss="modal" data-toggle="modal" data-target="#tambahModalDetail{{$p->id_pengiriman}}" style="width:80px;margin:5px">Tambah</button><hr/>
                                                <table id="" class="t">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Opsi</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php $countb = 0 ?>
                                                    @foreach($d_pengiriman as $d)
                                                    @if($d->id_pengiriman == $p->id_pengiriman)
                                                    <tr>
                                                        <?php $countb = $countb+1 ?>
                                                        <td>{{$countb}}</td>
                                                        @foreach($barang as $b)
                                                        @if($b->id_barang == $d->id_barang)
                                                        <?php $nama_barang = $b->nama_barang ?>
                                                            <td>{{ $nama_barang }}</td>
                                                        @endif
                                                        @endforeach
                                                        <td>{{ $d->jumlah_barang }}</td>
                                                        <td><button class="badge badge-info" data-toggle="modal" data-target="#editModalDetail{{$p->id_pengiriman}}_{{$d->id_barang}}">Edit</button></td>
                                                       <?php //$total += ($b->pivot->total_harga_barang) ?>
                                                    </tr>
                                                    <!-- Modal Edit Detail -->
                                                    <div class="modal fade" id="editModalDetail{{$p->id_pengiriman}}_{{$d->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_pengiriman }} - {{$d->id_barang}}  -  Edit Barang</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form autocomplete="off" method="post" action="{{ url('/pengiriman/detail/update/'.$p->id_pengiriman.'/'.$d->id_barang) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" class="form-control" id ="id_pengiriman" name="id_pengiriman" value="{{ $p->id_pengiriman }}">
                                                                        <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="view">Barang</label>
                                                                                <input type="text" class="form-control" id ="view" name="view" value="{{$d->id_barang}} - {{$nama_barang}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="stok_barang">Jumlah belum dikirim</label>
                                                                                <input type="number" class="form-control" id ="stok_" name="stok_" value="{{$belum_terkirim}}" disabled>
                                                                                <input type="number" class="form-control" id ="stok_barange" name="stok_barange" value="{{$belum_terkirim}}" hidden>
                                                                                <input type="number" class="form-control" id ="stok_jumlah" name="stok_jumlah" value="{{ $d->jumlah_barang }}" hidden>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="jumlah_barang">Jumlah</label>
                                                                                <input type="number" class="form-control" id ="jumlah_barang" name="jumlah_barang" value="{{ $d->jumlah_barang }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </br>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
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
                            <td>{{$p->keterangan}}</td>
                            <td>{{$p->timestamp}}</td>
                            <td style="width"><a href="{{ url('/pengiriman/cetak/'.$p->id_pengiriman) }}"><button class="badge badge-success" style="width:80px;margin:5px">Cetak</button><a>
                            <br/><button class="badge badge-info" style="width:80px;margin:5px" data-toggle="modal" data-target="#editModal{{$p->id_pengiriman}}">Edit</button></td>
                        </tr>
                        <!-- Modal Tambah Detail -->
                        <div class="modal fade" id="tambahModalDetail{{$p->id_pengiriman}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_pengiriman }} - Tambah Barang</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form autocomplete="off" method="post" action="{{ url('/pengiriman/detail/store/'.$p->id_pengiriman) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id ="id_penjualanj" name="id_penjualan" value="{{ $id_pj }}">
                                        <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="id_barang">ID Barang</label>
                                                    <input type="text" class="form-control" name="id_barang" id="id_barang" list="lstb">
                                                    <datalist id="lstb">
                                                        @foreach($d_penjualan as $dpj)
                                                        @if($dpj->id_penjualan == $p->id_penjualan)
                                                            @foreach($barang as $b)
                                                            @if($b->id_barang == $dpj->id_barang)
                                                                <option value="{{$dpj->id_barang}}" stk="{{$dpj->jumlah_barang}}">{{$b->nama_barang}} belum terkirim:{{$dpj->jumlah_barang - $dpj->jumlah_terkirim}}</option>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="stok_barang">Stok</label>
                                                    <input type="number" class="form-control" id ="stok_b" name="stok_b" disabled>
                                                    <input type="number" class="form-control" id ="stok_barang" name="stok_barang" hidden>
                                                </div>
                                            </div> -->
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
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{$p->id_pengiriman}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $p->id_pengiriman }} - Edit Data Pengiriman</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form autocomplete="off" method="post" action="{{ url('/pengiriman/update/'.$id_pj.'/'.$p->id_pengiriman) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="tgl_penjualan">Tanggal</label>
                                            <input type="date" class="form-control" id ="tgl_pengiriman" name="tgl_pengiriman" value="{{ $p->tgl_pengiriman }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Alamat Tujuan</label>
                                            <input type="text" class="form-control" id ="alamat_tujuan" name="alamat_tujuan" value="{{ $p->alamat_tujuan }}">
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengiriman</h5>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" method="post" action="{{ url('/pengiriman/store/'.$id_pj) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $id_pj }}">
                        <div class="form-group">
                            <label for="tgl_penjualan">Tanggal</label>
                            <input type="date" class="form-control" id ="tgl_pengiriman" name="tgl_pengiriman" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Alamat Tujuan</label>
                            <input type="text" class="form-control" id ="alamat_tujuan" name="alamat_tujuan">
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
    @endif
@endguest             
@endsection
@section('script')
<script type="text/javascript">
  
//    $('#id_barang').on('change', function(){
//         var value = $(this).val();

//         // var barang = [
//         //     @foreach ($barang as $b)
//         //         [ "{{ $b->id_barang }}","{{ $b->harga_jual }}","{{ $b->stok }}"], 
//         //     @endforeach
//         // ];
//         // for (var i = 0; i < barang.length; i++) {
//         //     if (barang[i][0] == value) {
//         //         var harga = barang[i][1];
//         //         var stokb = barang[i][2];
//         //     }
//         // }
//         // var harga = $(document.querySelectorAll('[id*="lstb"]')+'[value="' + value + '"]').attr('hrg');
//         // var stokb = $(document.querySelectorAll('[id*="lstb"]')+'[value="' + value + '"]').attr('stk');
//         //var harga = $('#lstb [value="' + value + '"]').attr('hrg');
//         var stokb = $('#lstb [value="' + value + '"]').attr('stk');
//         console.log(stokb);
//         $('#stok_barang').val(stokb);
//         $('#stok_b').val(stokb);
//         //$('#harga_barang').val(harga);
//     })
    
//     // init
//     $('#id_barang').change();

   $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('table.t tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('table.t').DataTable({
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
  
    
</script>
@endsection