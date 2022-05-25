@foreach($penjualan as $p)
    @foreach($p->barang as $b)
    
        @foreach($tgl as $t)
           <?php $test = $t?>
        @endforeach
        @if($p->tgl_penjualan == $test)
            {{$b->id_barang}}
        @endif
    @endforeach
    <br/>
@endforeach