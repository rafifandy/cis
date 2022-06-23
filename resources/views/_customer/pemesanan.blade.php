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
                Pilih barang
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
    
    $('#id_barang').on('change', function(){
        var value = $(this).val();
        var harga = $('#barang [value="' + value + '"]').attr('hrg');
        var stokb = $('#barang [value="' + value + '"]').attr('stk');
        console.log(harga);
        $('#stok_barang').val(stokb);
        $('#stok_b').val(stokb);
        $('#harga_barang').val(harga);
    })
    
    // init
    $('#id_barang').change();
</script>
@endsection