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
    </style>
@endsection
@section('content')
@guest
    <script>window.location = "/";</script>
@else
    @if(Auth::user()->role != 1)
    <body>
        
    <div class="container">
            
            <br/>
            <h1>Pemesanan</h1>
        <br/>
        <br/>
        <hr/>
        @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
        @endif

        <?php $countu = 0 ?>
        @foreach($pelanggan as $u)
            @if($u->email == Auth::user()->email)
                <?php 
                    $countu++;
                    $uid = $u->id_pelanggan;
                ?>
            @endif
        @endforeach
        <!-- Column pemesanan ; 1 = pilih barang, 2 = submit menunggu konfirmasi penjual, 0/null = ada di penjualan penjual -->
        @if($countu == 0)
            <script>window.location = "/";</script>
        @elseif($countu == 1)
            <?php $countpms = 0?>
            @foreach($penjualan as $sp)
                @if($sp->id_pelanggan == $uid and $sp->pemesanan == 1)
                    <?php 
                        $countpms++;
                    ?>
                @endif
            @endforeach
            @if($countpms == 0)
                <form autocomplete="off" method="post" action="{{ url('/cpemesanan/store') }}" enctype="multipart/form-data">
                     @csrf
                        <input type="hidden" class="form-control" name="id_pelanggan" id ="id_pelanggan" value="{{ $uid }}">
                        <input type="hidden" class="form-control" id ="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" class="form-control" id ="pemesanan" name="pemesanan" value="1">
                    </br>
                    <button type="submit" class="btn btn-success" onclick="return confirm('Mulai Pemesanan?')">Mulai Pemesanan</button>
                </form>
            @elseif($countpms == 1)
            @foreach($penjualan as $p)
                @if($sp->id_pelanggan == $uid and $p->pemesanan == 1)
                    <?php 
                        // $d_id0 = str_pad($p->id_penjualan,11,'0',STR_PAD_LEFT);
                        // $d_id = str_pad($d_id0,12,'P',STR_PAD_LEFT);
                        $p_id = $p->id_penjualan;
                    ?>
                    <br/>
                        <h5>ID - {{$p_id}}</h5>
                        <p>{{$p->timestamp}}</p>
                    <br/>
                    <table id="t" class="display cell-border">
                    <thead>
                        <tr style="background-color:#BDDFFF">
                            <th>No</th>
                            <th>Kode barang</th>
                            <th>Barang</th>
                            <th>Jumlah Pesan</th>
                            <th>Harga satuan</th>
                            <th>Total Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 0 ?>
                    @foreach($p->barang as $pb)
                        <tr>
                            <?php $count = $count+1 ?>
                            <td>{{$count}}</td>
                            <td>{{$pb->id_barang}}</td>
                            <td>{{$pb->nama_barang}}</td>
                            <td>{{$pb->pivot->jumlah_barang}}</td>
                            <td>Rp {{number_format($pb->pivot->harga_barang)}}</td>
                            <td>Rp {{number_format($pb->pivot->total_harga_barang)}}</td>
                            <td>
                                <button class="badge badge-info" style="width:80px;margin:5px" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}_{{$pb->id_barang}}">Edit</button>
                                <button class="badge badge-danger" style="width:80px;margin:5px" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}_{{$pb->id_barang}}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="5" style="text-align:right">Total :</td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td>Rp {{number_format($p->total)}}</td>
                            <td>
                                @if($p->total > 0)
                                    <button class="badge badge-success" style="width:170px;margin:5px" data-toggle="modal" data-target="#editModal{{$p->id_penjualan}}_{{$pb->id_barang}}">Submit pesanan</button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <hr/>
                        <h4>Pilih Barang</h4>
                        <p style="font-size:11px">*Stok dan harga dapat berubah</p><br/>
                        @include('/barang/kategori_btn')
                    <br/>
                    <br/>
                    <table id="t2" class="display cell-border">
                        <thead>
                            <tr style="background-color:#BDDFFF">
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 0 ?>
                        @foreach($barang as $b)
                            <?php $list = 0 ?>
                            @foreach($p->barang as $pb)
                                @if($b->id_barang == $pb->id_barang)
                                    <?php $list = 1 ?>
                                @endif
                            @endforeach
                            @if($list == 0)
                                <tr>
                                    <?php $count = $count+1 ?>
                                    <td>{{$count}}</td>
                                    <td>{{$b->id_barang}}</td>
                                    <td>{{$b->nama_barang}}</td>
                                    <td>
                                        
                                        <?php $jmlg = 0 ?>
                                        @foreach($gambar as $gb)
                                            @if($b->id_barang == $gb->id_barang)
                                            @if($jmlg == 0)
                                            <img src="{{ asset('storage/'.$gb->foto_barang) }}" data-toggle="modal" data-target="#view1Modal{{$gb->id_gambar}}" style='height: 100px; width: 100px; object-fit: contain'>
                                            <div class="modal fade" style="text-align: center" id="view1Modal{{$gb->id_gambar}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 100%; width: auto; max-height: 100%; height: auto; display: inline-block" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                        <img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'>
                                                        </div>
                                                        </br>
                                                        <div class="modal-footer">
                                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $jmlg++ ?>
                                            @endif
                                            @endif
                                        @endforeach
                                        <hr/>
                                        <button class="badge badge-info" data-toggle="modal" data-target="#modalGambar{{$b->id_barang}}" style="width:80px;margin:5px">More..</button>
                                        
                                        <div class="modal fade" id="modalGambar{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="t">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Gambar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $countgg = 0 ?>
                                                            @foreach($gambar as $gb)
                                                            @if($gb->id_barang == $b->id_barang)
                                                            <tr>
                                                                <?php $countgg = $countgg+1 ?>
                                                                <td>{{$countgg}}</td>
                                                                <td><img src="{{ asset('storage/'.$gb->foto_barang) }}" data-toggle="modal" data-target="#view2Modal{{$gb->id_gambar}}" style='height: 100px; width: 100px; object-fit: contain'></td>
                                                                <div class="modal fade" style="text-align: center" id="view2Modal{{$gb->id_gambar}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" style="max-width: 100%; width: auto; max-height: 100%; height: auto; display: inline-block" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                        <img src="{{ asset('storage/'.$gb->foto_barang) }}" style='height: 800px; width: 800px; object-fit: contain'>
                                                                        </div>
                                                                        </br>
                                                                        <div class="modal-footer">
                                                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                                <?php //$total += ($b->pivot->total_harga_barang) ?>
                                                            </tr>
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
                                    @if($b->harga_jual == null)
                                    <td>{{$b->harga_jual}}</td>
                                    @else
                                    <td style="text-align:right">{{number_format($b->harga_jual)}}</td>
                                    @endif
                                    <td>{{$b->stok}}</td>
                                    <td>{{$b->keterangan}}</td>
                                    <td><button class="badge badge-success" data-toggle="modal" data-target="#beliModal{{$b->id_barang}}">Beli</button></td>
                                </tr>
                                <!-- Modal Tambah Detail -->
                                <div class="modal fade" id="beliModal{{$b->id_barang}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Jumlah Beli - {{$b->nama_barang}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" method="post" action="{{ url('/cpemesanan/detail/store/'.$p_id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id ="id_penjualan" name="id_penjualan" value="{{ $p_id }}">
                                                <input type="hidden" class="form-control" id ="status" name="status" value="{{ $p->status + 1}}">
                                                <input type="hidden" class="form-control" id ="id_barang" name="id_barang" value="{{ $b->id_barang}}">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="stok_barang">Stok</label>
                                                            <input type="number" class="form-control" id ="stok" name="stok" value="{{$b->stok}}" disabled>
                                                            <input type="hidden" class="form-control" id ="stok_barang" name="stok_barang" value="{{ $b->stok}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="harga_barang">Harga</label>
                                                            <input type="number" class="form-control" id ="harga" name="harga" value="{{$b->harga_jual}}" disabled>
                                                            <input type="hidden" class="form-control" id ="harga_barang" name="harga_barang" value="{{$b->harga_jual}}"> 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
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
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
            @endforeach
            @endif
            
        @endif  
    @endif
    @if(Auth::user()->role == 1)
        <script>window.location = "/apemesanan";</script>
    @endif
@endguest

                
@endsection
@section('script')
<script type="text/javascript">
   
	$(document).ready( function () {
        $('#t').DataTable();
    } );

    $(document).ready( function () {
        $('#t2').DataTable();
    } );
    
    // $('#id_barang').on('change', function(){
    //     var value = $(this).val();
    //     var harga = $('#barang [value="' + value + '"]').attr('hrg');
    //     var stokb = $('#barang [value="' + value + '"]').attr('stk');
    //     console.log(harga);
    //     $('#stok_barang').val(stokb);
    //     $('#stok_b').val(stokb);
    //     $('#harga_barang').val(harga);
    // })
    
    // init
    $('#id_barang').change();
</script>
@endsection