@guest
    @if($k == 0)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @elseif($k == 1)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @elseif($k == 2)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @elseif($k == 3)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @elseif($k == 4)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @elseif($k == 5)
        <a href="{{ url('/gbarang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
        <a href="{{ url('/gbarang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
        <a href="{{ url('/gbarang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
        <a href="{{ url('/gbarang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
        <a href="{{ url('/gbarang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
        <a href="{{ url('/gbarang/5') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Lain-lain</button><a>
    @endif
@else
    @if(Auth::user()->role != 1)
        @if($k == 0)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 1)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 2)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 3)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 4)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 5)
            <a href="{{ url('/customer/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/customer/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/customer/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/customer/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/customer/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/customer/barang/5') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @endif
    @elseif(Auth::user()->role == 1)  
        @if($k == 0)
            <a href="{{ url('/barang') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 1)
            <a href="{{ url('/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 2)
            <a href="{{ url('/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 3)
            <a href="{{ url('/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 4)
            <a href="{{ url('/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @elseif($k == 5)
            <a href="{{ url('/barang') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">All</button><a>
            <a href="{{ url('/barang/1') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Kue</button><a>
            <a href="{{ url('/barang/2') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Makanan</button><a>
            <a href="{{ url('/barang/3') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Bahan Minuman</button><a>
            <a href="{{ url('/barang/4') }}"><button class="badge badge-primary" style="width:150px;margin-right:10px">Alat-alat</button><a>
            <a href="{{ url('/barang/5') }}"><button class="badge badge-secondary" style="width:150px;margin-right:10px">Lain-lain</button><a>
        @endif
    @endif
@endguest